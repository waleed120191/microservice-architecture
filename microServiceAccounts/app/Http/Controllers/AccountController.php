<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{

    public function index()
    {
        $accounts = Account::all();
        return $this->successResponse($accounts);
    }

    public function show($account)
    {
        $account = Account::findOrFail($account);
        return $this->successResponse($account);
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'user_id' => 'required|integer',
            'balance' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $account = Account::create($request->all());
        return $this->successResponse($account);

    }

    public function update(Request $request, $account)
    {
        $rules = [
            'name' => 'max:255',
            'user_id' => 'integer',
            'balance' => 'required|numeric'
        ];

        $this->validate($request, $rules);
        $account = Account::findOrFail($account);
        $account = $account->fill($request->all());

        if ($account->isClean()) {
            return $this->errorResponse('at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $account->save();
        return $this->successResponse($account);
    }


    public function destroy($account)
    {

        $account = Account::findOrFail($account);
        $account->delete();
        return $this->successResponse($account);
    }

    public function currentUserAccount($user_id){
        $account = Account::where('user_id', $user_id)->get();
        return $this->successResponse($account);
    }


}