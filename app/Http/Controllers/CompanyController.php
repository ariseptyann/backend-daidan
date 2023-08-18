<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\ApiModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    
    public function index()
    {
        $rst = Company::whereNull('deleted_at')->get();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'code'  => 'required',
            'name'  => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'code' => $req->input('code'),
			'name' => $req->input('name'),
		);

        $rst = Company::create($param);

        return ApiModel::resultSuccess($rst, Response::HTTP_CREATED, 'Data successfully created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'code'  => 'required',
            'name'  => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'code' => $req->input('code'),
			'name' => $req->input('name'),
		);

        $rst = Company::find($id);

        if (isset($rst)) {
            $rst->update($param);
            return ApiModel::resultSuccess($rst, Response::HTTP_CREATED, 'Data successfully updated');
        }

        return ApiModel::resultError(404, 'Data not found');
    }

    public function destroy($id)
    {
        $rst = Company::where('id', $id)->delete();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK, 'Data successfully deleted');
    }
}
