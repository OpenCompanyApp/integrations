<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HubSpot\HubSpotService;

/**
 * List companies in HubSpot CRM.
 *
 * Supports cursor pagination and optional property selection.
 */
class HubSpotListCompanies implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_companies';
    }

    public function description(): string
    {
        return 'List companies in HubSpot CRM with cursor-based pagination and optional property selection.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of companies to return (default 10, max 100).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'properties' => ['type' => 'array', 'description' => 'List of company property names to include.'],
        ];
    }

    /**
     * List HubSpot companies with optional property selection.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, after, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $params = $this->params($args);
            $result = $this->service->listCompanies($params);

            $companies = array_map(static fn (array $company): array => [
                'id' => $company['id'] ?? '',
                'properties' => $company['properties'] ?? [],
            ], $result['results'] ?? []);

            $output = ['results' => $companies, 'total' => count($companies)];

            if (isset($result['paging']['next']['after'])) {
                $output['after'] = $result['paging']['next']['after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build HubSpot list query parameters from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function params(array $args): array
    {
        $params = [];

        if (isset($args['limit'])) {
            $params['limit'] = (int) $args['limit'];
        }
        if (! empty($args['after'])) {
            $params['after'] = (string) $args['after'];
        }
        if (isset($args['properties']) && is_array($args['properties'])) {
            $params['properties'] = implode(',', $args['properties']);
        }

        return $params;
    }
}
