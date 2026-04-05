<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

class StatuspageUpdateIncident implements Tool
{
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_update_incident';
    }

    public function description(): string
    {
        return 'Update an existing incident on your Atlassian Statuspage. Change the status, add updates to the body, or modify impact level.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The incident ID to update.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'Updated incident title.',
            ],
            'status' => [
                'type' => 'string',
                'description' => 'Updated incident status. One of: "investigating", "identified", "monitoring", "resolved", "scheduled", "in_progress", "verifying", "completed".',
                'enum' => ['investigating', 'identified', 'monitoring', 'resolved', 'scheduled', 'in_progress', 'verifying', 'completed'],
            ],
            'impact' => [
                'type' => 'string',
                'description' => 'Updated impact level. One of: "none", "minor", "major", "critical".',
                'enum' => ['none', 'minor', 'major', 'critical'],
            ],
            'body' => [
                'type' => 'string',
                'description' => 'Updated incident body describing the latest status.',
            ],
            'component_ids' => [
                'type' => 'array',
                'description' => 'Updated array of component IDs affected by this incident.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $incidentId = $args['id'];
            unset($args['id']);

            // Filter out null / empty values so we only send what changed
            $updates = array_filter($args, fn ($value) => $value !== null && $value !== '');

            if (empty($updates)) {
                return ToolResult::error('No fields provided to update. Specify at least one of: name, status, impact, body, component_ids.');
            }

            $result = $this->service->updateIncident($incidentId, $updates);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
