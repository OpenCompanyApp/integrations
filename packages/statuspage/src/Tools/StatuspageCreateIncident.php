<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

class StatuspageCreateIncident implements Tool
{
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_create_incident';
    }

    public function description(): string
    {
        return 'Create a new incident on your Atlassian Statuspage. Specify the incident name, status, impact level, and an optional body describing the issue.';
    }

    public function parameters(): array
    {
        return [
            'name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'A short title for the incident (e.g. "API Latency in EU Region").',
            ],
            'status' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Incident status. One of: "investigating", "identified", "monitoring", "resolved", "scheduled", "in_progress", "verifying", "completed".',
                'enum' => ['investigating', 'identified', 'monitoring', 'resolved', 'scheduled', 'in_progress', 'verifying', 'completed'],
            ],
            'impact' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The impact level of the incident. One of: "none", "minor", "major", "critical".',
                'enum' => ['none', 'minor', 'major', 'critical'],
            ],
            'body' => [
                'type' => 'string',
                'description' => 'A detailed description of the incident and current status.',
            ],
            'component_ids' => [
                'type' => 'array',
                'description' => 'Array of component IDs affected by this incident.',
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

            $incident = [
                'name' => $args['name'],
                'status' => $args['status'],
                'impact' => $args['impact'],
            ];

            if (isset($args['body'])) {
                $incident['body'] = $args['body'];
            }

            if (isset($args['component_ids']) && is_array($args['component_ids'])) {
                $incident['component_ids'] = $args['component_ids'];
            }

            $result = $this->service->createIncident($incident);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
