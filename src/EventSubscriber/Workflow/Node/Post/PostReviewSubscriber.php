<?php

namespace App\EventSubscriber\Workflow\Node\Post;

use App\Model\Reviewable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostReviewSubscriber implements EventSubscriberInterface
{
    public function onWorkflowPostTransitionReview($event): void
    {
        $object = $event->getSubject();

        if ($object instanceof Reviewable) {
            $object->setReviewed(true);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.post.transition.Review' => 'onWorkflowPostTransitionReview',
        ];
    }
}
