<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Update an existing component on the configured Statuspage page.
 *
 * Supports component status changes and display metadata updates.
 */
class StatuspageUpdateComponent implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_update_component';
    }

    public function description(): string
    {
        return 'Update an existing component on the configured Atlassian Statuspage page.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The component ID to update.'],
            'name' => ['type' => 'string', 'description' => 'Updated component name.'],
            'status' => [
                'type' => 'string',
                'description' => 'Updated component status.',
                'enum' => ['operational', 'degraded_performance', 'partial_outage', 'major_outage', 'under_maintenance'],
            ],
            'description' => ['type' => 'string', 'description' => 'Updated component description.'],
            'group_id' => ['type' => 'string', 'description' => 'Updated component group ID.'],
            'only_show_if_degraded' => ['type' => 'boolean', 'description' => 'Whether to hide the component unless degraded.'],
            'showcase' => ['type' => 'boolean', 'description' => 'Whether to show this component prominently.'],
        ];
    }

    /**
     * Update a Statuspage component with supplied changed fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $componentId = $args['id'];
            unset($args['id']);

            $updates = array_filter($args, fn ($value) => $value !== null && $value !== '');

            if (empty($updates)) {
                return ToolResult::error('No fields provided to update. Specify at least one component field.');
            }

            return ToolResult::success($this->service->updateComponent($componentId, $updates));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
