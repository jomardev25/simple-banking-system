<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\BankService;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawalRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BankController extends Controller
{
    private $bankService;

    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    public function transfer(TransferRequest $request)
    {
        $isTransferSuccess = $this->bankService->transfer($request->account1, $request->account2, $request->amount);
        if(!$isTransferSuccess)
            return $this->apiResponse("Failed to transfer the amount.", Response::HTTP_OK);

        return $this->apiResponse("Amount successfully transferred.", Response::HTTP_OK);
    }

    public function deposit(DepositRequest $request)
    {
        $isDepositSuccess = $this->bankService->deposit($request->account, $request->amount);

        if(!$isDepositSuccess)
            return $this->apiResponse("Amount failed to deposit.", Response::HTTP_OK);

        return $this->apiResponse("Amount successfully deposited.", Response::HTTP_OK);
    }

    public function withdraw(WithdrawalRequest $request)
    {
        $isWithdrawalSuccess = $this->bankService->withdraw($request->account, $request->amount);

        if(!$isWithdrawalSuccess)
            return $this->apiResponse("Amount failed to withdraw.", Response::HTTP_OK);

        return $this->apiResponse("Amount successfully withdrawed.", Response::HTTP_OK);
    }
}