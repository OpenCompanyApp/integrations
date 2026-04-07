<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot deals.
 *
 * Returns a paginated list of deals with their IDs, names, and stages.
 */
class Hubspot3ListDeals implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_list_deals';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot deals.
        Returns deal IDs, names, stages, amounts, and associated contacts/companies.
        Use limit and offset for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deals to return (default 20, max 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (deal ID offset for continuing results).'],
            'properties' => ['type' => 'string', 'description' => 'Comma-separated list of deal properties to include (e.g. "dealname,amount,dealstage").'],
        ];
    }

    /**
     * List HubSpot deals.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, properties)
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
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['properties'])) {
                $props = explode(',', (string) $args['properties']);
                $params['properties'] = array_map('trim', $props);
            }

            $result = $this->service->listDeals($params);

            $deals = array_map(function (array $deal): array {
                $props = [];
                foreach ($deal['properties'] ?? [] as $key => $val) {
                    $props[$key] = $val['value'] ?? $val;
                }

                return [
                    'id' => $deal['dealId'] ?? $deal['id'] ?? '',
                    'name' => $props['dealname'] ?? '',
                    'stage' => $props['dealstage'] ?? '',
                    'amount' => $props['amount'] ?? '',
                    'pipeline' => $props['pipeline'] ?? '',
                    'properties' => $props,
                    'associations' => [
                        'contact_ids' => $deal['associations']['associatedVids'] ?? [],
                        'company_ids' => $deal['associations']['associatedCompanyIds'] ?? [],
                    ],
                ];
            }, $result['deals'] ?? []);

            $output = ['results' => $deals];

            if (isset($result['offset'])) {
                $output['next_offset'] = $result['offset'];
            }
            if (isset($result['hasMore'])) {
                $output['has_more'] = $result['hasMore'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
