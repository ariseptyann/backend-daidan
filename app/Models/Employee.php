<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "employees";
    protected $guarded = ['id'];

    const STATUS_ACTIVE     = "active";
    const STATUS_INACTIVE   = "inactive";

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->whereNull('deleted_at');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id')->whereNull('deleted_at');
    }

    public static function getAllEmployee($param, $limit = 10, $offset = 0) {
        $query = self::with(['company' => function($query){
            return $query->select('id', 'code', 'name');
        }, 'departement' => function($query){
            return $query->select('id', 'name');
        }])->whereNull('deleted_at')->select('*');

        if ($param['name']) {
            $query->where('name', $param['name']);
        }

        $queryCount     = $query;
        $total_number   = $queryCount->count();
        $skip           = $offset * $limit;

        $rst = array(
            'list'          => $query->offset($skip)->limit($limit)->get(),
            'limit'         => $limit,
            'offset'        => $offset,
            'total_number'  => $total_number,
            'total_page'    => ceil($total_number / $limit),
        );

        return $rst;
    }

    public static function statuses()
    {
        return array(
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        );
    }
}
