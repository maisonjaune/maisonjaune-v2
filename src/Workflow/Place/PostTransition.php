<?php

namespace App\Workflow\Place;

enum PostTransition: string
{
    case DRAFT = 'Draft';

    case WRITE = 'Write';

    case DECORATE = 'Decorate';

    case REVIEW = 'Review';

    case PUBLISH = 'Publish';

    case UNPUBLISH = 'Unpublish';
}
