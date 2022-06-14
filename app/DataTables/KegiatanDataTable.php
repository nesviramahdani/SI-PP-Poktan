<?php

namespace App\DataTables;

use App\Models\Kegiatan;
use \Yajra\Datatables\Datatables;

class KegiatanDataTable
{
	public function data()
	{
		$data = Kegiatan::with(['kelompoktani'])->latest();
		return DataTables::of($data)
			->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<div class="row"><a href="javascript:void(0)" id="'.$row->id.
                       '" class="btn btn-primary btn-sm ml-2 btn-edit"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '<a href="javascript:void(0)" id="'.$row->id.
                        '" class="btn btn-danger btn-sm ml-2 btn-delete"><i class="fas fa-trash fa-fw"></i></a></div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
	}
}