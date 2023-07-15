<?php

namespace App\Enums;

enum TaskStatus: string
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

    public function name(): string
    {
        // TODO: add translations
        return match ($this) {
            self::NOT_STARTED => 'Не розпочато',
            self::IN_PROGRESS => 'В процесі',
            self::FINISHED => 'Завершено',
        };
    }
}
