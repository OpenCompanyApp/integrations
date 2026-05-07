<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * Delete an incident from the configured Statuspage page.
 *
 * Use only when the incident should be removed rather than resolved.
 */
class StatuspageDeleteIncident implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_delete_incident';
    }

    public function description(): string
    {
        return 'Delete an incident from the configured Atlassian Statuspage page. Resolving is usually preferable for real incidents.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The incident ID to delete.'],
        ];
    }

    /**
     * Delete a Statuspage incident.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $this->service->deleteIncident($args['id']);

            return ToolResult::success(['deleted' => true, 'id' => $args['id']]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
