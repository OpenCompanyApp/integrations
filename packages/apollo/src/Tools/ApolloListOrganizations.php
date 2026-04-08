<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List organizations from the authenticated Apollo account.
 *
 * Returns a paginated list of organizations with key details
 * including name, website, industry, and employee count.
 */
class ApolloListOrganizations implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_list_organizations';
    }

    public function description(): string
    {
        return 'List organizations from your Apollo account. Returns paginated results with company details including name, website, industry, employee count, and revenue.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listOrganizations($page, $perPage);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the organizations list response for display.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response.
     */
    private function formatResponse(array $result): array
    {
        $organizations = $result['organizations'] ?? [];
        $pagination = $result['pagination'] ?? [];

        $formatted = array_map(function (array $org): array {
            return [
                'id' => $org['id'] ?? null,
                'name' => $org['name'] ?? null,
                'website_url' => $org['website_url'] ?? null,
                'industry' => $org['industry'] ?? null,
                'employee_count' => $org['employee_count'] ?? $org['estimated_num_employees'] ?? null,
                'revenue' => $org['annual_revenue_estimated'] ?? $org['revenue'] ?? null,
                'city' => $org['city'] ?? null,
                'state' => $org['state'] ?? null,
                'country' => $org['country'] ?? null,
                'linkedin_url' => $org['linkedin_url'] ?? null,
                'twitter_url' => $org['twitter_url'] ?? null,
            ];
        }, $organizations);

        return [
            'organizations' => $formatted,
            'total' => $pagination['total_entries'] ?? count($formatted),
            'page' => $pagination['page'] ?? $page,
            'per_page' => $pagination['per_page'] ?? 25,
            'total_pages' => $pagination['total_pages'] ?? null,
        ];
    }
}
