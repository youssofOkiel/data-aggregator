<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionYStatus extends Enum
{
    const authorised = 100;

    const decline = 200;

    const refunded = 300;
}
