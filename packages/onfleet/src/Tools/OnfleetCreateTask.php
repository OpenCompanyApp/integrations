<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new delivery task in Onfleet.
 *
 * Supports creating tasks with destination address, recipient details,
 * pickup/dropoff notes, time windows, and assignment to workers or teams.
 */
class OnfleetCreateTask implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_create_task';
    }

    public function description(): string
    {
        return 'Create a new delivery task in Onfleet. Requires a destination address and recipient details. Optionally assign to a worker or team, set time windows, and add notes.';
    }

    public function parameters(): array
    {
        return [
            'destination_address' => ['type' => 'string', 'required' => true, 'description' => 'Destination street address (e.g., "123 Main St, San Francisco, CA 94105").'],
            'destination_address_unparsed' => ['type' => 'string', 'description' => 'Full unparsed address string if you prefer Onfleet to geocode it.'],
            'recipient_name' => ['type' => 'string', 'required' => true, 'description' => 'Recipient full name.'],
            'recipient_phone' => ['type' => 'string', 'description' => 'Recipient phone number (E.164 format preferred).'],
            'recipient_email' => ['type' => 'string', 'description' => 'Recipient email address.'],
            'notes' => ['type' => 'string', 'description' => 'Notes for the driver about the task.'],
            'complete_after' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — earliest time task can be completed.'],
            'complete_before' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — latest time task must be completed by.'],
            'pickup_task' => ['type' => 'boolean', 'description' => 'Set to true if this is a pickup task instead of a dropoff.'],
            'worker' => ['type' => 'string', 'description' => 'Worker ID to directly assign the task to.'],
            'team' => ['type' => 'string', 'description' => 'Team ID to assign the task to (for auto-dispatch).'],
            'merchant' => ['type' => 'string', 'description' => 'Merchant/organization ID for the task.'],
            'executor' => ['type' => 'string', 'description' => 'Organization ID of the executor (for interconnected fleets).'],
            'quantity' => ['type' => 'integer', 'description' => 'Number of units for the task.'],
            'service_time' => ['type' => 'integer', 'description' => 'Estimated service time in seconds.'],
            'appearance' => ['type' => 'array', 'description' => 'Visual customization: {"triangleColor": "#RRGGBB"}.'],
            'metadata' => ['type' => 'array', 'description' => 'Custom metadata array: [{"name": "key", "value": "val", "visibility": ["worker"]}].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            $data = [];

            // Build destination
            $data['destination'] = [
                'address' => [
                    'unparsed' => $args['destination_address'] ?? $args['destination_address_unparsed'] ?? '',
                ],
            ];

            // Build recipient
            $recipient = ['name' => $args['recipient_name']];
            if (isset($args['recipient_phone'])) {
                $recipient['phone'] = $args['recipient_phone'];
            }
            if (isset($args['recipient_email'])) {
                $recipient['email'] = $args['recipient_email'];
            }
            $data['recipients'] = [$recipient];

            // Optional fields
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['complete_after'])) {
                $data['completeAfter'] = strtotime($args['complete_after']) * 1000;
            }
            if (isset($args['complete_before'])) {
                $data['completeBefore'] = strtotime($args['complete_before']) * 1000;
            }
            if (isset($args['pickup_task']) && $args['pickup_task']) {
                $data['pickupTask'] = true;
            }
            if (isset($args['worker'])) {
                $data['worker'] = $args['worker'];
            }
            if (isset($args['team'])) {
                $data['team'] = $args['team'];
            }
            if (isset($args['merchant'])) {
                $data['merchant'] = $args['merchant'];
            }
            if (isset($args['executor'])) {
                $data['executor'] = $args['executor'];
            }
            if (isset($args['quantity'])) {
                $data['quantity'] = (int) $args['quantity'];
            }
            if (isset($args['service_time'])) {
                $data['serviceTime'] = (int) $args['service_time'];
            }
            if (isset($args['appearance'])) {
                $data['appearance'] = $args['appearance'];
            }
            if (isset($args['metadata'])) {
                $data['metadata'] = $args['metadata'];
            }

            $result = $this->service->createTask($data);

            return ToolResult::success([
                'task' => $result,
                'message' => 'Task created successfully.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
