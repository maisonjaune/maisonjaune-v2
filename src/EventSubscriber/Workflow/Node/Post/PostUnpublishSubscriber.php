<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use App\Model\Publiable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostUnpublishSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionUnpublish($event): void
    {
        $object = $event->getSubject();

        if ($object instanceof Publiable) {
            $object->setPublishedAt(null);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Unpublish' => 'onWorkflowPostTransitionUnpublish',
        ];
    }
}
