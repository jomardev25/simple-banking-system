<?php

namespace App\Services\ServicesImpl;

use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Traits\ApiTraits;
use App\Services\BankService;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidAmountException;


class BankServiceImpl implements BankService
{
    use ApiTraits; 

    public function transfer($account1, $account2, $money)
    {
        return DB::transaction(function() use ($account1, $account2, $money) {
            $findAccount1 = Account::find($account1);
            if(is_null($findAccount1))
                throw new ResourceNotFoundException("Account 1", "account_num", $account1);

            $findAccount2 = Account::find($account2);

            if(is_null($findAccount2))
                throw new ResourceNotFoundException("Account 2", "account_num", $account2);

            if($money <= 0) 
                throw new InvalidAmountException("Invalid amount to tranfer.");

            
            $account1Balance = (int) $findAccount1->balance;
            $account2Balance = (int) $findAccount2->balance;
            
            $money = (int) $money;

            if($account1Balance >= $money){
                $account1NewBalance = $account1Balance - $money;
                $account2NewBalance = $account2Balance + $money;
                $findAccount1->update(["balance" => $account1NewBalance]);
                $findAccount2->update(["balance" => $account2NewBalance]);
                return true;
            }else{
                throw new InsufficientBalanceException($account1);
            }

            return false;
        });
    }

    public function deposit($account, $money)
    {
        return DB::transaction(function() use ($account, $money) {
            $findAccount = Account::find($account);

            if(is_null($findAccount))
                throw new ResourceNotFoundException("Account", "account_num", $account);

            if($money <= 0) 
                throw new InvalidAmountException("Invalid amount to deposit.");

            $balance = (int) $findAccount->balance;
            $money = (int) $money;
            $accountNewBalance = $balance + $money;

            $updateStatus = $findAccount->update(["balance" => $accountNewBalance]);

            return (bool) $updateStatus;
        });
    }

    public function withdraw($account, $money)
    {
        return DB::transaction(function() use ($account, $money) {
            $findAccount = Account::find($account);

            if(is_null($findAccount))
                throw new ResourceNotFoundException("Account", "account_num", $account);

            if($money <= 0) 
                throw new InvalidAmountException("Invalid amount to withdraw.");

            $balance = (int) $findAccount->balance;
            $money = (int) $money;
            
            if($balance >= $money){
                $accountNewBalance = $balance - $money;
                $updateStatus = $findAccount->update(["balance" => $accountNewBalance]);
                return (bool) $updateStatus;
            }else{
                throw new InsufficientBalanceException($account);
            }  
        });
    }
}