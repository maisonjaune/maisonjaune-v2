<?php

namespace App\Workflow\Place;

enum PostTransition: string
{
    case WRITE = 'Write';

    case DECORATE = 'Decorate';

    case EXAMINE = 'Examine';

    case PUBLISH = 'Publish';

    case UNPUBLISH = 'Unpublish';
}
