<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing delivery task in Onfleet.
 *
 * Supports updating destination, assignment, time windows, notes, and other
 * task properties. Only provided fields will be updated.
 */
class OnfleetUpdateTask implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_update_task';
    }

    public function description(): string
    {
        return 'Update an existing delivery task in Onfleet. Only the fields you provide will be changed. You can update destination, assignment, notes, time windows, and more.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The Onfleet task ID to update (24-character hex string).'],
            'destination_address' => ['type' => 'string', 'description' => 'New destination address.'],
            'notes' => ['type' => 'string', 'description' => 'Updated driver notes.'],
            'complete_after' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — earliest completion time.'],
            'complete_before' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — latest completion deadline.'],
            'worker' => ['type' => 'string', 'description' => 'Worker ID to assign (pass null or empty to unassign).'],
            'team' => ['type' => 'string', 'description' => 'Team ID to assign to.'],
            'quantity' => ['type' => 'integer', 'description' => 'Updated quantity.'],
            'service_time' => ['type' => 'integer', 'description' => 'Updated estimated service time in seconds.'],
            'appearance' => ['type' => 'array', 'description' => 'Visual customization: {"triangleColor": "#RRGGBB"}.'],
            'metadata' => ['type' => 'array', 'description' => 'Updated custom metadata.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            if (empty($args['task_id'])) {
                return ToolResult::error('Task ID is required.');
            }

            $data = [];

            // Build destination if address provided
            if (isset($args['destination_address'])) {
                $data['destination'] = [
                    'address' => [
                        'unparsed' => $args['destination_address'],
                    ],
                ];
            }

            // Optional updatable fields
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['complete_after'])) {
                $data['completeAfter'] = strtotime($args['complete_after']) * 1000;
            }
            if (isset($args['complete_before'])) {
                $data['completeBefore'] = strtotime($args['complete_before']) * 1000;
            }
            if (array_key_exists('worker', $args)) {
                $data['worker'] = $args['worker'] ?? '';
            }
            if (isset($args['team'])) {
                $data['team'] = $args['team'];
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

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Provide at least one field to change.');
            }

            $result = $this->service->updateTask($args['task_id'], $data);

            return ToolResult::success([
                'task' => $result,
                'message' => "Task {$args['task_id']} updated successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
