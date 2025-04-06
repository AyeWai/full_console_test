<?php

namespace Fulll\Infra\Events;

class EventDispatcher
{
    private array $listeners = [];

    public function subscribe(string $eventType, callable $listener): void
    {
        $this->listeners[$eventType][] = $listener;
    }

    public function dispatch(object $event): void
    {
        $eventType = get_class($event);
        if (!isset($this->listeners[$eventType])) {
            return;
        }

        foreach ($this->listeners[$eventType] as $listener) {
            $listener($event);
        }
    }
}
