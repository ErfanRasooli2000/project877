<?php

namespace Modules\Base\Services;

use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportService
{
    public function download(Collection $collection , string $resourceClass , string $filename)
    {
        return (new FastExcel(
            $this->exportToExcel($collection,$resourceClass)
        ))->download($filename);
    }

    private function exportToExcel($collection,$resourceClass)
    {
        if ($collection->isEmpty())
            yield $this->createEmptyHeader($resourceClass);

        foreach ($collection as $item) {
            yield new $resourceClass($item);
        }
    }

    private function createEmptyHeader($resourceClass)
    {
        $data = $resourceClass::$headers;
        $result = [];

        foreach ($data as $item)
            $result[$item] = "";

        return $result;
    }
}
