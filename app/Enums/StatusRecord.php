<?php

namespace App\Enums;

enum StatusRecord: string
{
    case pending   = 'Pendente';
    case accepted  = 'Aceito';
    case printed   = 'Impresso';
    case delivered = 'Entregue';
}
