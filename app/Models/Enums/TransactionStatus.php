<?php

namespace App\Models\Enums;

enum TransactionStatus
{
    const CREATED = 'aguardando pagamento';
    const IN_ANALISYS = 'em análise';
    const DECLINED = 'recusado';
    const CAPTURED = 'aprovado';
}
