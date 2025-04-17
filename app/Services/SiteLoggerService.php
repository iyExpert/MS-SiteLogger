<?php

namespace App\Services;

use App\Models\SiteLogger;
use App\Repositories\QueryFilters\BaseQueryFilterBuilder;
use App\Repositories\SiteLoggerRepository;
use Generator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use MongoDB\BSON\UTCDateTime;

class SiteLoggerService extends BaseService
{
    public function getItem(string $_id): SiteLogger
    {
        $repository = new SiteLoggerRepository();
        return $repository->getOrFail($_id);
    }

    public function filter(BaseQueryFilterBuilder $qb): LengthAwarePaginator
    {
        $repository = new SiteLoggerRepository();
        return $repository->filter($qb, $qb->limit(), $qb->page());
    }

    public function fullSave(Model $model, array $attributes): Model
    {
        return $this->save($model, $attributes);
    }

    public function save(Model $model, array $attributes): Model
    {
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    public function deleteMultiple(array $ids)
    {
        SiteLogger::destroy($ids);
    }

    public function clean($settings): string
    {
        $siteLogger = new SiteLogger();
        $msg = '';

        try {
            foreach ($settings as $entity => $setting) {
                if (isset($setting['date'])) {
                    $this->convertDateTo($setting);
                }

                $deletedCount = 0;

                foreach ($this->getMatchingIds($setting) as $batch) {
                    SiteLogger::destroy($batch);
                    $deletedCount += count($batch);
                }

                $msg .= (!$msg ? "Видалено: " : ", ") . $entity . " - " . $deletedCount;
            }

            $this->save($siteLogger, $this->logCleanStuff(substr($msg, -1)));
            return $msg;
        } catch (\Exception $e) {
            $this->save($siteLogger, $this->logCleanStuff($e->getMessage(), true));
            throw $e;
        }
    }

    private function convertDateTo(& $setting): array
    {
        foreach ($setting['date'] as $key => $value) {
            $setting['date'][$key] = new UTCDateTime($value * 1000);
        }

        return $setting;
    }

    private function getMatchingIds(array $setting, int $batchSize = 100): Generator
    {
        yield from SiteLogger::raw(function ($collection) use ($setting, $batchSize) {
            $cursor = $collection->find(
                $setting,
                ['projection' => ['_id' => 1]]
            );

            $batch = [];
            foreach ($cursor as $doc) {
                $batch[] = (string)$doc['_id'];
                if (count($batch) >= $batchSize) {
                    yield $batch;
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                yield $batch;
            }
        });
    }


    private function logCleanStuff(string $msg, bool $error = false): array
    {
        return [
            "title" => env('APP_NAME', 'MS-SiteLogger') === 'MS-SiteLogger' ? 'Clean site logger' : 'Clean error logger',
            "action" => 'SiteLoggerController_clean',
            "tags" => [[
                'entity' => 'clean_site_logger'
            ]],
            "log" => [[
                'message' => $msg
            ]],
            "type" => $error ? 'ERROR' : 'INFO',
            "date" => Carbon::now()
        ];
    }
}
