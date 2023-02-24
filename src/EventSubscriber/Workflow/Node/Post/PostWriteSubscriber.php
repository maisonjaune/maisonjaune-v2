<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostWriteSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionWrite($event): void
    {
        $event->getSubject()->setDraft(false);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Write' => 'onWorkflowPostTransitionWrite',
        ];
    }
}
