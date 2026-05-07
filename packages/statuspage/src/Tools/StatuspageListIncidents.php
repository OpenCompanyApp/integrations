<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * List incidents for the configured Statuspage page.
 *
 * Includes active, scheduled, and resolved incidents depending on API filters.
 */
class StatuspageListIncidents implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_list_incidents';
    }

    public function description(): string
    {
        return 'List all incidents for your Atlassian Statuspage. Returns scheduled, ongoing, and resolved incidents with their current status and impact.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of incidents to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'q' => ['type' => 'string', 'description' => 'Optional search query supported by the Statuspage API.'],
        ];
    }

    /**
     * List Statuspage incidents using optional query parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Statuspage integration is not configured. Please provide an API key and Page ID.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['q'])) {
                $params['q'] = $args['q'];
            }

            $result = $this->service->listIncidents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
