<?php

namespace Marchex;

/**
 * Class Account
 *
 * @package Marchex
 **/
class Account
{
    /**
     * Retrieves the list of accounts accessible by the user.
     *
     * @return Collection
     */
    public function list()
    {
        $request = new Request();
        $request->send('acct.list');
        return $request->getOutput();
    }
}
