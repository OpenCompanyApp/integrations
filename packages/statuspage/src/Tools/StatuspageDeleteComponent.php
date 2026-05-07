<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Delete a component from the configured Statuspage page.
 *
 * Use carefully because deleted components disappear from the public page.
 */
class StatuspageDeleteComponent implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_delete_component';
    }

    public function description(): string
    {
        return 'Delete a component from the configured Atlassian Statuspage page.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The component ID to delete.'],
        ];
    }

    /**
     * Delete a Statuspage component.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $this->service->deleteComponent($args['id']);

            return ToolResult::success(['deleted' => true, 'id' => $args['id']]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
