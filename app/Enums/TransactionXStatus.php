<?php

namespace App\Enums;

enum TransactionXStatus
{
    const authorised = 1;

    const decline = 2;

    const refunded = 3;
}
