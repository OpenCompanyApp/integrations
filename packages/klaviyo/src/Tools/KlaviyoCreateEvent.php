<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Track a new event for a Klaviyo profile.
 */
class KlaviyoCreateEvent implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_create_event';
    }

    public function description(): string
    {
        return <<<'MD'
        Track a new event for an existing Klaviyo profile.
        Provide the profile ID, event name, and optional properties, numeric value, and timestamp.
        Events are used to trigger flows and segment profiles based on behaviour.
        MD;
    }

    public function parameters(): array
    {
        return [
            'profile_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo profile ID to associate the event with.',
            ],
            'event_name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The event name (metric name), e.g. "Placed Order".',
            ],
            'properties' => [
                'type' => 'object',
                'description' => 'Event properties as key-value pairs.',
            ],
            'value' => [
                'type' => 'number',
                'description' => 'Numeric value associated with the event (e.g. order total).',
            ],
            'time' => [
                'type' => 'string',
                'description' => 'ISO 8601 timestamp of when the event occurred.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $profileId = $args['profile_id'] ?? '';
            if (empty($profileId)) {
                return ToolResult::error('The "profile_id" parameter is required.');
            }

            $eventName = $args['event_name'] ?? '';
            if (empty($eventName)) {
                return ToolResult::error('The "event_name" parameter is required.');
            }

            $result = $this->service->createEvent(
                profileId: $profileId,
                eventName: $eventName,
                properties: $args['properties'] ?? [],
                value: isset($args['value']) ? (float) $args['value'] : null,
                time: $args['time'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
