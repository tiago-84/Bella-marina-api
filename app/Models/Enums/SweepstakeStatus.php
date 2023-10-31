<?php

namespace App\Models\Enums;

enum SweepstakeStatus
{
    const DRAFT = 'Em rascunho';

    const AVAILABLE = 'Disponível';
    const CLOSED = 'Encerrado';
    const COMPLETED = 'Finalizado';
}
