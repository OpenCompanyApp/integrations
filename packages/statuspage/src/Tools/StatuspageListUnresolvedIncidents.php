<?php

namespace OpenCompany\Integrations\Statuspage\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Statuspage\StatuspageService;

/**
 * List unresolved incidents for the configured Statuspage page.
 *
 * Restricts results to incidents that have not reached a resolved or completed state.
 */
class StatuspageListUnresolvedIncidents implements Tool
{
    /**
     * @param  StatuspageService  $service  The Statuspage API client.
     */
    public function __construct(
        private StatuspageService $service,
    ) {}

    public function name(): string
    {
        return 'statuspage_list_unresolved_incidents';
    }

    public function description(): string
    {
        return 'List unresolved incidents for the configured Atlassian Statuspage page.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of incidents to return per page.'],
        ];
    }

    /**
     * List unresolved Statuspage incidents.
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
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            return ToolResult::success($this->service->listUnresolvedIncidents($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
