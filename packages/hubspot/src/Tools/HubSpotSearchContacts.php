<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search HubSpot contacts using filter groups and/or text query.
 *
 * Supports HubSpot CRM search syntax with filterGroups, properties selection, and pagination.
 */
class HubSpotSearchContacts implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_search_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        Search HubSpot contacts using filter groups and/or a text query.
        Use filterGroups for structured queries (e.g., email equals "x@y.com").
        Use query for full-text search across searchable properties.
        Supports pagination with limit and after parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Full-text search query.'],
            'filter_groups' => ['type' => 'array', 'description' => 'Array of filter groups, each containing filters with propertyName, operator, and value.'],
            'properties' => ['type' => 'array', 'description' => 'List of property names to include in results.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default 10, max 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Search HubSpot contacts with filter groups or text query.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, filter_groups, properties, limit, after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $body = [];

            if (! empty($args['query'])) {
                $body['query'] = $args['query'];
            }
            if (isset($args['filter_groups']) && is_array($args['filter_groups'])) {
                $body['filterGroups'] = $args['filter_groups'];
            }
            if (isset($args['properties']) && is_array($args['properties'])) {
                $body['properties'] = $args['properties'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }
            if (! empty($args['after'])) {
                $body['after'] = $args['after'];
            }

            $result = $this->service->searchContacts($body);

            $contacts = array_map(function (array $contact): array {
                return [
                    'id' => $contact['id'] ?? '',
                    'properties' => $contact['properties'] ?? [],
                ];
            }, $result['results'] ?? []);

            $output = ['results' => $contacts, 'total' => $result['total'] ?? count($contacts)];

            if (isset($result['paging']['next']['after'])) {
                $output['after'] = $result['paging']['next']['after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
