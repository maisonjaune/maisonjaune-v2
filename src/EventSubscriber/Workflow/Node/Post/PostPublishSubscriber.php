<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use App\Model\Publiable;
use DateTimeImmutable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostPublishSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionPublish($event): void
    {
        $object = $event->getSubject();

        if ($object instanceof Publiable) {
            $object->setPublishedAt(new DateTimeImmutable());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Publish' => 'onWorkflowPostTransitionPublish',
        ];
    }
}
