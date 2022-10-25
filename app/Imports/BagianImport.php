<?php

namespace App\Imports;

use App\Models\bagian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BagianImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new bagian([
            'namaTenant' => $row['nama_ruangan'],
            'penanggungJawab' => $row['nama_penanggung_jawab'],
            'tlpn' => $row['no_telepon'],
            'email' => $row['e_mail'],
            'lantaiTenant' => $row['letak_ruangan'],
        ]);
    }
}
