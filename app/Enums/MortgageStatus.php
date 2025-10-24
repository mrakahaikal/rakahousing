<?php

namespace App\Enums;

enum MortgageStatus : string
{
    case Pending = 'Waiting for Bank approval';
    case Approved = 'Approved';
    case Rejected = 'Rejected';
}
