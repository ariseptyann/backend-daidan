<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\ApiModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    public function index(Request $req)
    {
        $param = array(
            'name'  => $req->input('name'),
        );

        $rst    = Employee::getAllEmployee($param);

        return ApiModel::resultSuccess($rst);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'company_id'        => 'required',
            'departement_id'    => 'required',
            'name'              => 'required',
            'nik'               => 'required|unique:employees|integer',
            'join_date'         => 'required',
            'status'            => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'company_id'        => $req->input('company_id'),
			'departement_id'    => $req->input('departement_id'),
            'name'              => $req->input('name'),
            'nik'               => $req->input('nik'),
            'join_date'         => $req->input('join_date'),
            'date_of_birth'     => $req->input('date_of_birth'),
            'status'            => $req->input('status'),
		);

        $rst = Employee::create($param);

        return ApiModel::resultSuccess($rst, Response::HTTP_CREATED, 'Data successfully created');
    }

    public function show($id)
    {
        $rst = Employee::with('company', 'departement')->where('id', $id)->first();
        
        return ApiModel::resultSuccess($rst, Response::HTTP_OK);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'company_id'        => 'required',
            'departement_id'    => 'required',
            'name'              => 'required',
            'nik'               => 'required|integer',
            'join_date'         => 'required',
            'status'            => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'company_id'        => $req->input('company_id'),
			'departement_id'    => $req->input('departement_id'),
            'name'              => $req->input('name'),
            'nik'               => $req->input('nik'),
            'join_date'         => $req->input('join_date'),
            'date_of_birth'     => $req->input('date_of_birth'),
            'status'            => $req->input('status'),
		);

        $rst = Employee::find($id);

        if (isset($rst)) {
            $rst->update($param);
            return ApiModel::resultSuccess($rst, Response::HTTP_CREATED, 'Data successfully updated');
        }

        return ApiModel::resultError(404, 'Data not found');
    }

    public function destroy($id)
    {
        $rst = Employee::where('id', $id)->delete();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK, 'Data successfully deleted');
    }

    public function statuses() {
        $rst = Employee::statuses();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK);
    }
}
