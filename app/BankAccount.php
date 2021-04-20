<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','account_no','account_name','account_type','branch','financial_organization_id','swift_code','route_no'];

}
