<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOTrackEvent implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_track_event';
    }

    public function description(): string
    {
        return 'Track a custom event for a customer in Customer.io. Events trigger campaign workflows and can be used to segment customers.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Customer identifier (must match the ID used when identifying the customer).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Event name (e.g., "purchase", "signup", "plan_changed").'],
            'data' => ['type' => 'object', 'description' => 'Event data payload — key-value pairs with event details (e.g., {"product": "Pro Plan", "amount": 99}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $id = $args['id'];
            $eventName = $args['name'];
            $data = $args['data'] ?? [];

            $result = $this->service->trackEvent($id, $eventName, $data);

            return ToolResult::success(array_merge([
                'message' => "Event '{$eventName}' tracked for customer '{$id}'.",
                'customer_id' => $id,
                'event' => $eventName,
            ], $result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
