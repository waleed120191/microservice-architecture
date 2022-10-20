<?php

declare(strict_types = 1);

namespace App\Services;

use App\Traits\RequestService;
use GuzzleHttp\Psr7\Request;

use function config;

class AccountService
{
    use RequestService;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $secret;

    /**
     * AccountService constructor.
     */
    public function __construct()
    {
        $this->baseUri = config('services.accounts.base_uri');
        $this->secret = config('services.accounts.secret');
    }

    /**
     * @return string
     */
    public function fetchAccounts() : string
    {
        return $this->request('GET', '/api/account');
    }

    /**
     * @param $account
     *
     * @return string
     */
    public function fetchAccount($account) : string
    {
        return $this->request('GET', "/api/account/{$account}");
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function createAccount($data) : string
    {
        return $this->request('POST', '/api/account', $data);
    }

    /**
     * @param $account
     * @param $data
     *
     * @return string
     */
    public function updateAccount($account, $data) : string
    {
        return $this->request('PATCH', "/api/account/{$account}", $data);
    }

    /**
     * @param $account
     *
     * @return string
     */
    public function deleteAccount($account) : string
    {
        return $this->request('DELETE', "/api/account/{$account}");
    }

    public function currentUserAccount($user_id) : string
    {
        return $this->request('GET', "/api/account/currentUserAccount/{$user_id}");
    }
    
}
