<?php

namespace App\Enum\Card;

enum Type: string
{
    case Club = 'club';
    case Diamond = 'diamond';
    case Heart = 'heart';
    case Spade = 'spade';
}
