<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListGroups — Search for groups in Amplitude.
 *
 * Calls GET /api/2/groupsearch with a query string and optional limit.
 * Returns matching group records.
 */
class AmplitudeListGroups implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_groups';
    }

    public function description(): string
    {
        return 'Search for groups in Amplitude by query string. Returns matching group accounts with their properties.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search term — group name, group ID, or other identifier.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of groups to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $result = $this->service->listGroups(
                query: $args['query'],
                limit: $limit,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
