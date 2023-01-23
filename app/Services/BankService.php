<?php

namespace App\Services;

interface BankService
{
    public function transfer($account1, $account2, $money);

    public function deposit($account, $money);

    public function withdraw($account, $money);
}