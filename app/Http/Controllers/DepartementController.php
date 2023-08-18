<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\ApiModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DepartementController extends Controller
{
    
    public function index()
    {
        $rst = Departement::whereNull('deleted_at')->get();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name'  => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'name' => $req->input('name'),
		);

        $rst = Departement::create($param);

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
            'name'  => 'required'
        ]);

        if ($validator->fails()) {
            return ApiModel::resultError(Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $param = array(
			'name' => $req->input('name'),
		);

        $rst = Departement::find($id);

        if (isset($rst)) {
            $rst->update($param);
            return ApiModel::resultSuccess($rst, Response::HTTP_CREATED, 'Data successfully updated');
        }

        return ApiModel::resultError(404, 'Data not found');
    }

    public function destroy($id)
    {
        $rst = Departement::where('id', $id)->delete();

        return ApiModel::resultSuccess($rst, Response::HTTP_OK, 'Data successfully deleted');
    }
}
