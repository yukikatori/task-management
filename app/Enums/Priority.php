<?php

namespace App\Enums;

enum Priority: int
{
    case High = 1;
    case Medium = 2;
    case Low = 3;

    public function label(): string
    {
        return match($this) {
            self::High => '高',
            self::Medium => '中',
            self::Low => '低',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::High => 'red',
            self::Medium => 'orange',
            self::Low => 'green',
        };
    }
}