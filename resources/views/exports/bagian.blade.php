<table>
    <thead>
        <tr>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">No</td>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">Nama Ruangan</td>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">Nama Penanggung Jawab</td>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">No. Telepon</td>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">E-mail</td>
            <td style="background-color: #35A9DB; color: #ffffff; font-weight: normal; border: 1px solid black; border-collapse: collapse; ">Letak Ruangan</td>
        </tr>
    </thead>
    <tbody>
        @foreach($bagian as $index => $bg)
        <tr>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $index + 1 }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $bg->namaTenant }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $bg->penanggungJawab }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $bg->tlpn }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $bg->email }}</td>
            <td style="border: 1px solid black; border-collapse: collapse; ">{{ $bg->lantaiTenant }}</td>
        </tr>
        @endforeach
    </tbody>
</table>