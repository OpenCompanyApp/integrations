<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Create a component on the configured Statuspage page.
 *
 * Components represent systems, services, or groups shown on a public status page.
 */
class StatuspageCreateComponent implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_create_component';
    }

    public function description(): string
    {
        return 'Create a component on the configured Atlassian Statuspage page.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Component name shown on the status page.'],
            'status' => [
                'type' => 'string',
                'description' => 'Initial component status.',
                'enum' => ['operational', 'degraded_performance', 'partial_outage', 'major_outage', 'under_maintenance'],
            ],
            'description' => ['type' => 'string', 'description' => 'Optional component description.'],
            'group_id' => ['type' => 'string', 'description' => 'Optional component group ID.'],
            'only_show_if_degraded' => ['type' => 'boolean', 'description' => 'Whether to hide the component unless degraded.'],
            'showcase' => ['type' => 'boolean', 'description' => 'Whether to show this component prominently.'],
        ];
    }

    /**
     * Create a Statuspage component from normalized arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $component = ['name' => $args['name']];
            foreach (['status', 'description', 'group_id', 'only_show_if_degraded', 'showcase'] as $field) {
                if (array_key_exists($field, $args)) {
                    $component[$field] = $args[$field];
                }
            }

            return ToolResult::success($this->service->createComponent($component));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
