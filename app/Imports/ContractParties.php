<?php

namespace App\Imports;

use App\Models\ContractParty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class ContractParties implements ToModel
{
    use Importable;

    protected $added_by;
    protected $manner_of_transfer;
    protected $currentRow = 0;
    protected $errors = [];

    public function __construct($manner_of_transfer)
    {
        $this->added_by = Auth::id();
        $this->manner_of_transfer = $manner_of_transfer;
    }

    public function model(array $row)
    {
        // Skip the first row (header)
        if ($this->currentRow == 0) {
            $this->currentRow++;
            return null;
        }

        $validator = Validator::make(['unique_number' => $row[0]], [
            'unique_number' => 'unique:contract_parties',
        ]);

        if ($validator->fails()) {
            $this->errors[] = "Contract party with unique_number {$row[0]} already exists.";
            return null;
        }
    // Calculate total_house_price
    $totalHouseArea = (float) $row[16]; // Assuming $row[16] contains total_house_area
    $pricePerSquare = (float) $row[17]; // Assuming $row[17] contains price_per_square
    $totalHousePrice = $totalHouseArea * $pricePerSquare;
        $this->currentRow++;
        return new ContractParty([
            'unique_number' => $row[0],
            'full_name' => $row[1],
            'gender' => $row[2],
            'manner_of_transfer' => $this->manner_of_transfer,
            'personal_sub_city' => $row[4],
            'personal_wereda' => $row[5],
            'personal_phone' => $row[6],
            'house_sub_city' => $row[7],
            'house_wereda' => $row[8],
            'site_name' => $row[9],
            'building_number' => $row[10],
            'floor_number' => $row[11],
            'house_number' => $row[12],
            'bedroom_number' => $row[13],
            'net_house_area' => $row[14],
            'common_area' => $row[15],
            'total_house_area' => $totalHouseArea,
            'price_per_square' => $pricePerSquare,
            'total_house_price' => $totalHousePrice,
            'category_id' => $row[19], // Assuming $row[19] contains the category ID
            'added_by' => $this->added_by,
        ]);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
