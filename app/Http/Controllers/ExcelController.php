<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function getExcel()
    {
        return view('tutor.import');
    }
 
    /**
     * Post Excel file to save into database
     * @param  Request $request [description]
     * @return [type]           [description]
     */

 public function importExcel(Request $request)
{
    $request->validate([
        'import_file' => 'required'
    ]);

    $path = $request->file('import_file')->getRealPath();
    $data = Excel::load($path)->get();

    if ($data->count()) {
        foreach ($data as $key => $value) {
            $arr[] = [
                'kode_barang' => $value->kode_barang,
                'nama_barang' => $value->nama_barang,
                'kategori_id' => $value->kategori_id,
                'jumlah_barang' => $value->jumlah_barang,
                'harga_satuan' => $value->harga_satuan,
                'tanggal_inputan' => $value->tanggal_inputan,
                'deskripsi' => $value->deskripsi,
                'status' => $value->status,

            ];
        }

        if (!empty($arr)) {
            Item::insert($arr);
        }
    }

    return back()->with('success', 'Insert Record successfully.');
}
    public function downloadExcel($type)
    {
        $data = Country::get()->toArray();
 
        return Excel::create('country', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
