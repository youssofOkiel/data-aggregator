<?php

namespace App\Enums;

enum TransactionYStatus
{
    const authorised = 100;

    const decline = 200;

    const refunded = 300;
}
