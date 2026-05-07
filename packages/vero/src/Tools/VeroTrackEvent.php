<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Track a behavioral event for a user in Vero.
 *
 * Records an event (for example, "Logged in" or "Purchased item") for a user,
 * which can trigger automated email campaigns in Vero.
 */
class VeroTrackEvent implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_track_event';
    }

    public function description(): string
    {
        return 'Track a behavioral event for a user in Vero. Pass an identity object with id and/or email, an event name, optional event data, and optional extras such as source or created_at.';
    }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => ['object', 'string'], 'required' => true, 'description' => 'Identity object with id and/or email. A string is accepted for legacy calls and sent as id.'],
            'event_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the event to track (e.g., "Logged in", "Added to cart", "Purchased").'],
            'data' => ['type' => 'object', 'description' => 'Event-specific data as key-value pairs (e.g., {"product": "Widget", "price": 29.99}).'],
            'extras' => ['type' => 'object', 'description' => 'Optional Vero-specific extras such as source, created_at, or conversion data.'],
        ];
    }

    /**
     * Execute the track event tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $identity = $args['identity'] ?? '';
            $eventName = $args['event_name'] ?? '';

            if (empty($identity)) {
                return ToolResult::error('User identity (ID or email) is required.');
            }

            if (empty($eventName)) {
                return ToolResult::error('Event name is required.');
            }

            $data = $args['data'] ?? [];
            $extras = $args['extras'] ?? [];

            $result = $this->service->trackEvent($identity, $eventName, $data, $extras);

            return ToolResult::success([
                'identity' => $identity,
                'event_name' => $eventName,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'tracked',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
