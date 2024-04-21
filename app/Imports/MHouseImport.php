<?php

namespace App\Imports;

use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
set_time_limit(900);
class MHouseImport implements ToModel
{
    use Importable;

    protected $added_by;
    protected $category_id;
    protected $currentRow = 0;
    protected $errors = [];

    public function __construct($category_id)
    {
        $this->category_id = $category_id;
        $this->added_by = Auth::id();
    }

    public function model(array $row)
    {
        // Skip the first row (header)
        if ($this->currentRow == 0) {
            $this->currentRow++;
            return null;
        }
        
        $houseNumber = $row[3];

        // Validate house_number uniqueness
        $validator = Validator::make(['house_number' => $houseNumber], [
            'house_number' => 'unique:houses',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $this->errors[] = "House with house_number $houseNumber already exists.";
            return null; // Skip saving this row
        }

        $this->currentRow++;
        return new House([
            'building_number' => $row[1],
            'sub_city_wereda' => $row[2],
            'site_name' => $row[3],
            'house_number' => $houseNumber,
            'house_height' => $row[5],
            'floor_number' => $row[6],
            'net_house_area' => $row[7],
            'common_area' => $row[8],
            'total_house_area' => $row[9],
            'initial_price_per_square' => $row[10],
            'added_by' => $this->added_by,
            'category_id' => $this->category_id,
        ]);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
