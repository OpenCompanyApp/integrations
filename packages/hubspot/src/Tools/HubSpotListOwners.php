<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot CRM owners (users).
 *
 * Returns a paginated list of owners with their IDs, names, and emails.
 */
class HubSpotListOwners implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_owners';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot CRM owners (users).
        Returns owner IDs, names, and emails. Useful for assigning owners to contacts, deals, and tickets.
        Supports pagination with limit and after parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of owners to return (default 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List HubSpot CRM owners with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->listOwners($params);

            $owners = array_map(function (array $owner): array {
                return [
                    'id' => $owner['id'] ?? '',
                    'email' => $owner['email'] ?? '',
                    'first_name' => $owner['firstName'] ?? '',
                    'last_name' => $owner['lastName'] ?? '',
                    'user_id' => $owner['userId'] ?? null,
                ];
            }, $result['results'] ?? []);

            $output = ['results' => $owners];

            if (isset($result['paging']['next']['after'])) {
                $output['after'] = $result['paging']['next']['after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
