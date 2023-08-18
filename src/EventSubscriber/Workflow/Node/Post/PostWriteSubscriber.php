<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use App\Model\Draftable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostWriteSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionWrite($event): void
    {
        $object = $event->getSubject();

        if ($object instanceof Draftable) {
            $object->setDraft(false);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Write' => 'onWorkflowPostTransitionWrite',
        ];
    }
}
