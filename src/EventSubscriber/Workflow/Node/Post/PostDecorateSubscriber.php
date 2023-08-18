<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use App\Model\Decoratable;
use App\Model\Reviewable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostDecorateSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionDecorate($event): void
    {
        $object = $event->getSubject();

        if ($object instanceof Decoratable) {
            $object->setDecorated(true);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Decorate' => 'onWorkflowPostTransitionDecorate',
        ];
    }
}
