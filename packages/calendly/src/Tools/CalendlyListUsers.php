<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users (organization memberships) in Calendly.
 *
 * Retrieves memberships for a given organization, supporting
 * pagination and user filtering.
 */
class CalendlyListUsers implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_users';
    }

    public function description(): string
    {
        return 'List users (organization memberships) in a Calendly organization.';
    }

    public function parameters(): array
    {
        return [
            'organization' => ['type' => 'string', 'description' => 'The organization URI to filter by (e.g. https://api.calendly.com/organizations/...).'],
            'user' => ['type' => 'string', 'description' => 'The user URI to filter by.'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results per page (default 20, max 100).'],
        ];
    }

    /**
     * List organization memberships / users.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $params = [];

            if (isset($args['organization'])) {
                $params['organization'] = $args['organization'];
            }
            if (isset($args['user'])) {
                $params['user'] = $args['user'];
            }
            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
