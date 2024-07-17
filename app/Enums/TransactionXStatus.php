<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionXStatus extends Enum
{
    const authorised = 1;

    const decline = 2;

    const refunded = 3;
}
