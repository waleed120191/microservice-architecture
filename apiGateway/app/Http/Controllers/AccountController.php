<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    private $accountService;

    /**
     * AccountController constructor.
     *
     * @param \App\Services\AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->successResponse($this->accountService->fetchAccounts());
    }

    /**
     * @param $account
     *
     * @return mixed
     */
    public function show($account)
    {
        return $this->successResponse($this->accountService->fetchAccount($account));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->accountService->createAccount($request->all()));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $account
     *
     * @return mixed
     */
    public function update(Request $request, $account)
    {
        return $this->successResponse($this->accountService->updateAccount($account, $request->all()));
    }

    /**
     * @param $account
     *
     * @return mixed
     */
    public function destroy($account)
    {
        return $this->successResponse($this->accountService->deleteAccount($account));
    }

    /**
     * @param $account
     *
     * @return mixed
     */
    public function currentUserAccount(Request $request)
    {
        $user_id = $request->user()->id;
        return $this->successResponse($this->accountService->currentUserAccount($user_id));
    }
}
