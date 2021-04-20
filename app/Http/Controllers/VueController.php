<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\FinancialOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VueController extends Controller
{
//
    public function Index()
    {
        $banklist = FinancialOrganization::all();
        return view('bank', compact('banklist'));
    }

    public function getBankData()
    {
        return FinancialOrganization::all();
    }
    public function getBAData()
    {
        return BankAccount::all();
    }

    public function postBAStore(Request $r)
    {
        $this->validate($r,[
            'account_name' => 'required',
            'account_no' => 'required|numeric',
            'account_type' => 'required|numeric',
            'route_no' => 'required|numeric',
            'branch' => 'required',
            'financial_organization_id' => 'required'
        ]);
        BankAccount::create($r->all());
        return ['success'=>true,'message'=>'Inserted Successfully'];
    }

    public function postBAUpdate(Request $r)
    {
        if($r->has('id')){
            BankAccount::find($r->input('id'))->update($r->all());
            return ['success'=>true,'message'=>'Updated Successfully'];
        }
    }

    public function postBADelete(Request $r){
        if($r->has('id')){
            BankAccount::find($r->input('id'))->delete();
            return ['success'=>true,'message'=>'Deleted Successfully'];
        }
    }







}
