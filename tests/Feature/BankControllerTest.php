<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class BankControllerTest extends TestCase
{
    public function testTransferSuccessfull()
    {
        $this->post('/api/v1/banks/transfer', [
            'account1' => 1,
            'account2' => 2,
            'amount' => 2
        ])
        ->assertJson([
            'message' => 'Amount successfully transferred.',
        ])->assertStatus(Response::HTTP_OK); 
    }

    public function testTransferInsufficientBalance()
    {
        $response = $this->post('/api/v1/banks/transfer', [
            'account1' => 1,
            'account2' => 2,
            'amount' => 100000000
        ])->assertJson([
            'message' => sprintf("Insufficient balance with account number: %s", 1),
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testTransferInvalidAmount()
    {
        $response = $this->post('/api/v1/banks/transfer', [
            'account1' => 1,
            'account2' => 2,
            'amount' => -100
        ])->assertJson([
            'message' => 'Invalid amount to tranfer.',
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testDepositSuccessfull()
    {
        $this->post('/api/v1/banks/deposit', [
            'account' => 1,
            'amount' => 200
        ])
        ->assertJson([
            'message' => 'Amount successfully deposited.',
        ])->assertStatus(Response::HTTP_OK); 
    }

    public function testDepositInvalidAmount()
    {
        $response = $this->post('/api/v1/banks/deposit', [
            'account' => 1,
            'amount' => -100
        ])->assertJson([
            'message' => 'Invalid amount to deposit.',
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testWithdrawSuccessfull()
    {
        $response = $this->post('/api/v1/banks/withdraw', [
            'account' => 1,
            'amount' => 10
        ])->assertJson([
            'message' => 'Amount successfully withdrawed.',
        ])->assertStatus(Response::HTTP_OK);
    }

    public function testWithdrawInsufficientBalance()
    {
        $response = $this->post('/api/v1/banks/withdraw', [
            'account' => 1,
            'amount' => 100000000
        ])->assertJson([
            'message' => sprintf("Insufficient balance with account number: %s", 1),
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testWithdrawInvalidAmount()
    {
        $response = $this->post('/api/v1/banks/withdraw', [
            'account' => 1,
            'amount' => -100
        ])->assertJson([
            'message' => 'Invalid amount to withdraw.',
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
