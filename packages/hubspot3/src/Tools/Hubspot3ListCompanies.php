<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot companies.
 *
 * Returns a paginated list of companies with their IDs and properties.
 */
class Hubspot3ListCompanies implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_list_companies';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot companies.
        Returns company IDs, names, domains, and other properties.
        Use limit and offset for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of companies to return (default 20, max 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (company ID offset for continuing results).'],
            'properties' => ['type' => 'string', 'description' => 'Comma-separated list of company properties to include (e.g. "name,domain,industry").'],
        ];
    }

    /**
     * List HubSpot companies.
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

            $result = $this->service->listCompanies($params);

            $companies = array_map(function (array $company): array {
                $props = [];
                foreach ($company['properties'] ?? [] as $key => $val) {
                    $props[$key] = $val['value'] ?? $val;
                }

                return [
                    'id' => $company['companyId'] ?? $company['id'] ?? '',
                    'name' => $props['name'] ?? '',
                    'domain' => $props['domain'] ?? '',
                    'industry' => $props['industry'] ?? '',
                    'properties' => $props,
                ];
            }, $result['companies'] ?? []);

            $output = ['results' => $companies];

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
