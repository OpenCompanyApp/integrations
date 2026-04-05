<?php

namespace OpenCompany\IntegrationCore\Support;

/**
 * Value object returned by Trigger::process() and Trigger::poll().
 *
 * Wraps zero or more events. Each event is an associative array of data
 * that the host application dispatches to automations, agents, or handlers.
 */
class TriggerResult
{
    /**
     * @param  list<array<string, mixed>>  $events  Zero or more event payloads
     * @param  array<string, mixed>  $meta  Optional metadata (timing, debug info)
     */
    public function __construct(
        public readonly array $events = [],
        public readonly array $meta = [],
    ) {}

    /**
     * Create a result with one or more events.
     *
     * @param  list<array<string, mixed>>  $events
     */
    public static function from(array $events, array $meta = []): self
    {
        return new self(events: $events, meta: $meta);
    }

    /**
     * Create a result with a single event.
     *
     * @param  array<string, mixed>  $event
     */
    public static function event(array $event, array $meta = []): self
    {
        return new self(events: [$event], meta: $meta);
    }

    /**
     * Create an empty result (no events).
     */
    public static function empty(): self
    {
        return new self();
    }

    /**
     * Whether any events were produced.
     */
    public function hasEvents(): bool
    {
        return $this->events !== [];
    }

    /**
     * Number of events produced.
     */
    public function count(): int
    {
        return count($this->events);
    }
}
