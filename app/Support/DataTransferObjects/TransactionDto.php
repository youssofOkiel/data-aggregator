<?php

namespace App\Support\DataTransferObjects;

use App\Support\DataProviders\ProviderStrategyContext;
use DateTime;

class TransactionDto
{
    public function __construct(
        public float $amount,
        public string $currency,
        public string $userEmail,
        public string $status,
        public DateTime $date,
        public string $identification
    ) {}

    public static function fromArray($providerName, array $transactionData): self
    {
        $transactionData = (new ProviderStrategyContext($providerName))->map($transactionData);

        return new self(
            $transactionData['amount'],
            $transactionData['currency'],
            $transactionData['user_email'],
            $transactionData['status'],
            $transactionData['date'],
            $transactionData['identification']
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'user_email' => $this->userEmail,
            'status' => $this->status,
            'date' => $this->date,
            'identification' => $this->identification,
        ];
    }
}
