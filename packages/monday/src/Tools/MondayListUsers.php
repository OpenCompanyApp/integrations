<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users on a Monday.com account.
 *
 * Retrieves users with optional filtering by user kind
 * (e.g., "all", "guests", "non_guests", "non_pending").
 */
class MondayListUsers implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_users';
    }

    public function description(): string
    {
        return 'List users on a Monday.com account.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default 25).'],
            'kind'  => ['type' => 'string',  'description' => 'User kind filter: "all", "guests", "non_guests", or "non_pending".'],
        ];
    }

    /**
     * Retrieve a list of users with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, kind)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $limit = $args['limit'] ?? 25;

            $params = "limit: {$limit}";

            if (isset($args['kind']) && ! empty($args['kind'])) {
                $params .= ", kind: {$args['kind']}";
            }

            $query = <<<GRAPHQL
            query {
                users ({$params}) {
                    id
                    name
                    email
                    title
                    avatar_url
                    is_guest
                    enabled
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            return ToolResult::success($result['users'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
