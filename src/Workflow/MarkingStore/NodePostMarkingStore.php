<?php

namespace App\Workflow\MarkingStore;

use App\Entity\Node\Post;
use App\Workflow\Place\PostPlace;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

class NodePostMarkingStore implements MarkingStoreInterface
{
    /**
     * @param Post $subject
     * @return Marking
     */
    public function getMarking(object $subject): Marking
    {
        $marking = new Marking;

        $marking->mark(PostPlace::INITIALISATION->value);

        if (null !== $subject->getTitle() && null !== $subject->getSlug()) {
            $marking->mark(PostPlace::IN_WRITING->value);
        }

        if (!$subject->isDraft()) {
            $marking->mark(PostPlace::DECORATED->value);
            $marking->mark(PostPlace::EXAMINED->value);
        }

        return $marking;
    }

    /**
     * @param Post $subject
     * @param Marking $marking
     * @param array $context
     * @return void
     */
    public function setMarking(object $subject, Marking $marking, array $context = [])
    {
        // TODO: Implement setMarking() method.
    }
}