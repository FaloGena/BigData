<?php


namespace App\Services\Transfer;


use App\Models\CustomUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class SpatieService extends BaseService
{

    /**
     * @inheritDoc
     */
    public function import($file)
    {
        $path = $file->storeAs('csv', 'temp.csv');
        $path = Storage::path($path);

        /* @SimpleExcelReader on 34 line should be manually changed "mixed -> ?mixed" (i have no idea why it's the case)
         * https://github.com/spatie/simple-excel/issues/97
         */
        $rows = SimpleExcelReader::create($path)->getRows();

        $parsed = [];
        $rows->each(function(array $rowProperties) use(&$parsed) {

            $validator = Validator::make($rowProperties, self::VALIDATION_RULES, self::VALIDATION_MESSAGES);

            $row = $validator->validated();
            $row['created_at'] = $row['updated_at'] = now();

            $parsed[] = $row;
        });

        CustomUser::insert($parsed);
    }

    /**
     * @inheritDoc
     */
    public function export($customUsers, string $fileName)
    {
        $writer = SimpleExcelWriter::streamDownload($fileName);

        foreach ($customUsers as $user) {
            $row = $this->modelToRow($user);

            $writer->addRow($row);
        }

    }
}
