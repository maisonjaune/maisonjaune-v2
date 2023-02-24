<?php

namespace App\Enum\Node;

enum FormPostType: string
{
    case TYPE_CREATE = 'create';

    case TYPE_WRITE = 'write';

    case TYPE_REVIEW = 'review';

    case TYPE_DECORATE = 'decorate';

    case TYPE_PUBLISH = 'publish';
}