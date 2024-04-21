<?php

namespace App\Imports;

use App\Models\Bidder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class BiddersImport implements ToModel
{
    use Importable;

    protected $added_by;
    protected $biider_station_id;
    protected $currentRow = 0;
    protected $errors = [];

    public function __construct($biider_station_id)
    {
        $this->added_by = Auth::id();
        $this->biider_station_id = $biider_station_id;
    }

    public function model(array $row)
    {
        // Skip the first row (header)
        if ($this->currentRow == 0) {
            $this->currentRow++;
            return null;
        }

        $validator = Validator::make(['receipt_number' => $row[3]], [
            'receipt_number' => 'unique:bidder',
        ]);

        if ($validator->fails()) {
            $this->errors[] = "Bidder with receipt_number {$row[3]} already exists.";
            return null;
        }

        $this->currentRow++;
        return new Bidder([
            'full_name' => $row[1],
            'gender' => $row[2],
            'receipt_number' => $row[3],
            'phone' => $row[4],
            'added_by' => $this->added_by,
            'status' => "added",
            'biider_station_id' => $this->biider_station_id,
        ]);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
