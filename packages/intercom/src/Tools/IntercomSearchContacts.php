<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Intercom contacts using structured queries.
 *
 * Uses the Intercom search query structure with operator AND/OR and field-based filters.
 */
class IntercomSearchContacts implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_search_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        Search Intercom contacts using structured queries.
        The query uses an operator ("AND" or "OR") with an array of value filters.
        Each filter has a field, operator (e.g. "=", "!=", "IN", "LIKE"), and value.
        Example: {"operator": "AND", "value": [{"field": "email", "operator": "=", "value": "user@example.com"}]}
        Supports pagination with pagination_limit and pagination_after.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'object', 'required' => true, 'description' => 'Search query with operator and value array. Example: {"operator": "AND", "value": [{"field": "email", "operator": "=", "value": "user@example.com"}]}'],
            'pagination_limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default 20).'],
            'pagination_after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Search Intercom contacts with a structured query.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, pagination_limit, pagination_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $query = $args['query'] ?? [];
            if (empty($query) || ! is_array($query)) {
                return ToolResult::error('query is required and must be an object.');
            }

            $body = ['query' => $query];

            if (isset($args['pagination_limit'])) {
                $body['pagination']['per_page'] = (int) $args['pagination_limit'];
            }
            if (! empty($args['pagination_after'])) {
                $body['pagination']['starting_after'] = $args['pagination_after'];
            }

            $result = $this->service->searchContacts($body);

            $contacts = array_map(function (array $contact): array {
                return [
                    'id' => $contact['id'] ?? '',
                    'email' => $contact['email'] ?? '',
                    'name' => $contact['name'] ?? '',
                    'role' => $contact['role'] ?? '',
                    'custom_attributes' => $contact['custom_attributes'] ?? [],
                ];
            }, $result['data'] ?? []);

            $output = ['results' => $contacts, 'total' => $result['total_count'] ?? count($contacts)];

            if (isset($result['pages']['next']['starting_after'])) {
                $output['pagination_after'] = $result['pages']['next']['starting_after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
