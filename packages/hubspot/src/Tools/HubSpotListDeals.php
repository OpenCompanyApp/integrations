<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals in HubSpot CRM with pagination.
 *
 * Returns a paginated list of deals with their properties.
 */
class HubSpotListDeals implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_deals';
    }

    public function description(): string
    {
        return <<<'MD'
        List deals in HubSpot CRM with cursor-based pagination.
        Optionally specify properties to include and control page size.
        Use the "after" cursor from a previous response to fetch the next page.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deals to return (default 10, max 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'properties' => ['type' => 'array', 'description' => 'List of property names to include in results.'],
        ];
    }

    /**
     * List HubSpot deals with pagination and optional property selection.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, after, properties)
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
            if (isset($args['properties']) && is_array($args['properties'])) {
                $params['properties'] = implode(',', $args['properties']);
            }

            $result = $this->service->listDeals($params);

            $deals = array_map(function (array $deal): array {
                return [
                    'id' => $deal['id'] ?? '',
                    'properties' => $deal['properties'] ?? [],
                ];
            }, $result['results'] ?? []);

            $output = ['results' => $deals, 'total' => count($deals)];

            if (isset($result['paging']['next']['after'])) {
                $output['after'] = $result['paging']['next']['after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
