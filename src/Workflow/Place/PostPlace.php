<?php

namespace App\Workflow\Place;

enum PostPlace: string
{
    case INITIALISATION = 'Initialisation';

    case IN_WRITING = 'In writing';

    case EXAMINED = 'Examined';

    case DECORATED = 'Decorated';

    case UNPUBLISHED = 'UnPublished';

    case PUBLISHED = 'Published';
}
