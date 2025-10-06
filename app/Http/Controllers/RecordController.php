<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RecordController extends Controller
{
    /**
     * Get data for records table on Dashboard page
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        return DataTables::of(Record::all())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<button type="button" class="btn btn-info view-record" data-bs-toggle="modal" data-bs-target="#recordModal" data-id='.$row->id.'><i class="bi bi-search"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Get data for record modal on Dashboard page
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     */
    public function show(Request $request, int $id) {
        return Record::find($id)->toJSON();
    }
}
