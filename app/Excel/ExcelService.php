<?php
namespace App\Excel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class ExcelService
{
    public function import(UploadedFile $file, array $rules, Model $model, array $columnHeaders = [], array $relationNames = [], array $needed_columns): bool
    {


        // Read the data from the Excel file
        DB::beginTransaction();
        try {
            $data = (new FastExcel)->import($file->getRealPath(), function ($line) use ($model, $needed_columns, $relationNames, $rules, $columnHeaders) {

                if (!isset($line[$columnHeaders[0]]) || empty($line[$columnHeaders[0]])) {
                    return;
                }
                $validation = $this->validateData($line, $rules);

                $exists = $model::where($needed_columns['Name'], $line[$columnHeaders[0]])->exists();
                if ($exists) {
                    return;
                }
                if ($validation->fails()) {
                    throw new \Exception($validation->errors()->first());
                }

                $newModel = new $model;
                foreach ($needed_columns as $key => $column) {
                    if (array_key_exists($key, $line)) {
                        $value = $line[$key];
                        if ($column == 'date' && $value instanceof \DateTime) {
                            $value = $value->format('Y-m-d');
                        }
                        $newModel->{$column} = $value;
                    } else {
                        $newModel->{$column} = null;
                    }
                }

                foreach ($relationNames as $relation) {
                    if (array_key_exists($relation['display'], $line)) {
                        $row = $relation['model']::where($relation['column'], trim($line[$relation['display']]))->first();
                        if ($row) {
                            $newModel->{$relation['foreign_key']} = $row->id;
                        } else {
                            $newModel->{$relation['foreign_key']} = null;
                        }
                    } else {
                        $newModel->{$relation['foreign_key']} = null;
                    }
                }
                $newModel->save();
            });



            DB::commit(); // Commit the transaction if all queries are successful

            // //Check if the data array is empty
            // if ($data->isEmpty()) {
            //     throw new \Exception('The Excel file is empty.', 201);
            // }

            return true;
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if any query fails
            throw $e;
        }
    }


    public function export(array $data, Model $model, array $columnHeaders = [], array $relationNames = [])
    {

        if (empty($data)) {
            throw new \Exception('There Is No Data to Export.', 201);
        }

        $dataWithRelations = $this->includeRelations($data, $model, $relationNames, $columnHeaders);


        $headerStyle = (new Style())->setBorder(new Border([new BorderPart('left'), new BorderPart('right'), new BorderPart('bottom')]))->setFontName('Calibri')->setFontSize(14)->setBackgroundColor("ededed")
            ->setCellAlignment('center');

        $rowsStyle = (new Style())
            ->setCellAlignment('center')
            ->setFontSize(11)
            ->setShouldWrapText();

        return (new FastExcel($dataWithRelations))
            ->headerStyle($headerStyle)
            ->rowsStyle($rowsStyle)
            ->sheet('Sheet 1')
            ->export('export.xlsx');

        //   return $sheet;
    }
    private function includeRelations(array $data, Model $model, array $relationNames, $columnHeaders): array
    {
        //dd($relationNames);
        foreach ($columnHeaders as $key => $value) {
            // dd($columnHeaders);
            $columnHeaders[$key] = strtolower($value);
            $columnHeaders[$key] = str_replace(' ', '_', $columnHeaders[$key]);
        }
        // Include the specified relation data
        foreach ($data as $key => &$row) {
            $modelInstance = $model->find((int) $row['id']);



            $firstArrayKeys = array_values($columnHeaders);
            $secondArrayKeys = array_keys($row);


            $row = array_diff_key($row, array_flip(array_diff($secondArrayKeys, $firstArrayKeys)));
            foreach ($relationNames as $index => $relationName) {
                $relationValue = $modelInstance->$index;
                if (isset($relationValue) && isset($relationName)) {
                    $row[$relationName['display']] = $relationValue->{$relationName['column']};
                }
            }
        }

        return $data;
    }

    private function validateData(array $data, array $rules): \Illuminate\Contracts\Validation\Validator
    {
        //  dd($data,$rules);
        $validator = Validator::make($data, $rules);

        return $validator;
    }


    function exportFromCollection($data,$columnHeaders)
    {
        $exportData = [];

        $exportData[] = $columnHeaders;

        // Add data rows to the export data
        foreach ($data as $row) {
            $sub_area=FireSysArea::find($row->main_area_id)->name;
            $main_area=FireSysArea::find($row->sub_area_id)->name;
            $rowData = [
                $row->list_type,
                $row->name,
                $main_area,
                $sub_area,
                date('Y-m-d H:i:s', strtotime($row->updated_at)),
                $row->status,
            ];
            $exportData[] = $rowData;
        }

        // Generate a filename for the exported file
        $filename = 'exported_data_' . time() . '.xlsx';

        // Export the data to an Excel file
        (new FastExcel($exportData))->withoutHeaders()->export(public_path($filename));

        // Return the filename of the exported file
        return $filename;
    }


    // function extractAreaFromName($name,$search) {

    //     $sub_index = strpos($name, $search);
    //     if ($sub_index === false) {
    //       return '';
    //     }

    //     $space_index = strpos($name, '-', $sub_index);
    //     if ($space_index === false) {
    //       return '';
    //     }

    //     return substr($name, $sub_index + 4, $space_index - $sub_index - 4);
    //   }


}
