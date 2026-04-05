<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VeroTrackEvent implements Tool
{
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_track_event';
    }

    public function description(): string
    {
        return 'Track a custom event for a user in Vero. The user must already be identified in Vero. Provide the user\'s identity and the event name. Optionally include event properties as key-value data.';
    }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier — the same ID or email used when identifying the user.'],
            'event_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the event to track (e.g., "Purchase Completed", "Signed Up").'],
            'data' => ['type' => 'object', 'description' => 'Optional event properties as key-value pairs (e.g., {"amount": 49.99, "currency": "USD"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $identity = $args['identity'];
            $eventName = $args['event_name'];
            $data = $args['data'] ?? [];

            if (is_string($data)) {
                $data = json_decode($data, true) ?? [];
            }

            $result = $this->service->trackEvent($identity, $eventName, $data);

            return ToolResult::success([
                'message' => "Event '{$eventName}' tracked for user '{$identity}'.",
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
