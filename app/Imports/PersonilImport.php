<?php

namespace App\Imports;

use App\Models\Personil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonilImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function  __construct($id)
    {
        $this->mitra_id = $id;
    }
    public function model(array $row)
    {
        return new personil([
            'nama' => $row['nama_personil'],
            'workingpermit_id' => $this->mitra_id
        ]);
    }
}
