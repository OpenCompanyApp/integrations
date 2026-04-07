<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List event types for a Calendly user or organization.
 *
 * Supports filtering by active status, user, organization and pagination via page tokens.
 */
class CalendlyListEventTypes implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_event_types';
    }

    public function description(): string
    {
        return 'List event types for a Calendly user or organization.';
    }

    public function parameters(): array
    {
        return [
            'user' => ['type' => 'string', 'description' => 'The user URI to filter by (e.g. https://api.calendly.com/users/...).'],
            'organization' => ['type' => 'string', 'description' => 'The organization URI to filter by.'],
            'active' => ['type' => 'boolean', 'description' => 'Filter by active status. true returns only active event types.'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results per page (default 20, max 100).'],
        ];
    }

    /**
     * List event types with optional filtering and pagination.
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

            if (isset($args['user'])) {
                $params['user'] = $args['user'];
            }
            if (isset($args['organization'])) {
                $params['organization'] = $args['organization'];
            }
            if (isset($args['active'])) {
                $params['active'] = $args['active'] ? 'true' : 'false';
            }
            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }

            $result = $this->service->listEventTypes($params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
