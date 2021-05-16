<?php

namespace App\Event;

use App\Service\Denormalizer;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SyncEquipmentData
 * @package App\Event
 */
class SyncEquipmentData implements EventSubscriber
{
    public function __construct(private Denormalizer $denormalizer,private SerializerInterface $serializer)
    {
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
//        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $data = $this->serializer->serialize($args->getEntity(), 'xml');
        $this->denormalizer->syncRent($this->serializer, $data);
//        return  '';
    }
}
