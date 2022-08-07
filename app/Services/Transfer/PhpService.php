<?php


namespace App\Services\Transfer;


use App\Models\CustomUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class PhpService extends BaseService
{
    /**
     * @inheritDoc
     */
    public function import($file)
    {
        $parsed = $this->parseCSV($file, self::FIELDS);

//        dd($parsed);
        return CustomUser::insert($parsed);
    }

    /**
     * @inheritDoc
     */
    public function export($customUsers, $fileName)
    {
        $headers = $this->getExportHeaders($fileName);

        $writeToCSV = function() use($customUsers) {
            $this->writeToCSV(self::FIELDS, $customUsers);
        };

        return response()->stream($writeToCSV, 200, $headers);
    }

    /**
     * @param $file
     * @param $fields
     * @return array
     */
    protected function parseCSV($file, $fields)
    {
        $file = fopen($file, "r");

        $row = 0;
        $parsed = [];
        while (($data = fgetcsv($file, 10000, ",")) !== FALSE)
        {

            if ($row !== 0) {

                foreach ($fields as $i => $field) { // could use FIELDS from first row in CSV, but im hardcoding it
                    $parsedRow[$field] = $data[$i];
                }

                $validator = Validator::make($parsedRow, self::VALIDATION_RULES, self::VALIDATION_MESSAGES);

                $parsedRow = $validator->validated();
                $parsedRow['created_at'] = $parsedRow['updated_at'] = now();

                $parsed []= $parsedRow;


            }

            ++$row;
        }

        return $parsed;
    }

    /**
     * @param array $fields
     * @param Collection<CustomUser> $customUsers
     * @return mixed
     */
    protected function writeToCSV($fields, $customUsers)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $fields);

        foreach ($customUsers as $user) {
            $row = $this->modelToRow($user);

            fputcsv($file, $row);
        }

        fclose($file);
    }
}
