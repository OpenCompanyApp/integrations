<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing companies from Gainsight.
 *
 * Retrieves companies from the Gainsight customer success platform
 * with support for filtering and pagination.
 */
class GainsightListCompanies implements Tool
{
    /**
     * Create a new GainsightListCompanies tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_list_companies';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List companies from Gainsight. Returns company details including name, industry, ARR, health score, and lifecycle stage.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starting from 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of companies to return (default: 50).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter companies by name.'],
        ];
    }

    /**
     * Execute the list companies tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing company data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = $args['limit'];
            }
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }

            $result = $this->service->listCompanies($params);

            $companies = $result['companies'] ?? $result['data'] ?? [];
            $totalCount = count($companies);
            $response = [
                'companies' => $companies,
                'count' => $totalCount,
            ];

            if (isset($result['totalRecords'])) {
                $response['totalRecords'] = $result['totalRecords'];
            }
            if (isset($result['total'])) {
                $response['totalRecords'] = $result['total'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
