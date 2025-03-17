<?php

namespace App\Enums;

enum ProductStatus: string
{
    case Draft = 'draft';
    case Trash = 'trash';
    case Published = 'published';
}
