<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListUsers — Search for users in Amplitude.
 *
 * Calls GET /api/2/usersearch with a query string and optional limit.
 * Returns matching user records with IDs and key properties.
 */
class AmplitudeListUsers implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_users';
    }

    public function description(): string
    {
        return 'Search for users in Amplitude by query string. Matches against user ID, name, email, and other identifiable fields. Returns a list of matching users.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search term — user ID, name, email, or other identifier.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $result = $this->service->listUsers(
                query: $args['query'],
                limit: $limit,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
