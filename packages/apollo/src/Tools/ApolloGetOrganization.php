<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve full details for a specific Apollo organization by ID.
 *
 * Returns comprehensive organization data including contact counts,
 * industry, tech stack, locations, and key people.
 */
class ApolloGetOrganization implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_get_organization';
    }

    public function description(): string
    {
        return 'Retrieve full details for a specific organization in Apollo by its ID. Returns comprehensive company data including industry, employee count, revenue, tech stack, locations, and key contacts.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Apollo organization ID (e.g., "63f3b1c2XXXXXXXXXXXX").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $id = $args['id'];
            $result = $this->service->getOrganization($id);

            $org = $result['organization'] ?? $result;

            return ToolResult::success($this->formatOrganization($org));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format an organization record for display.
     *
     * @param  array<string, mixed>  $org  Raw organization data from the API.
     * @return array<string, mixed> Formatted organization data.
     */
    private function formatOrganization(array $org): array
    {
        return [
            'id' => $org['id'] ?? null,
            'name' => $org['name'] ?? null,
            'website_url' => $org['website_url'] ?? null,
            'industry' => $org['industry'] ?? null,
            'subindustry' => $org['subindustry'] ?? null,
            'employee_count' => $org['employee_count'] ?? $org['estimated_num_employees'] ?? null,
            'revenue' => $org['annual_revenue_estimated'] ?? $org['revenue'] ?? null,
            'founded_year' => $org['founded_year'] ?? null,
            'description' => $org['short_description'] ?? $org['description'] ?? null,
            'city' => $org['city'] ?? null,
            'state' => $org['state'] ?? null,
            'country' => $org['country'] ?? null,
            'linkedin_url' => $org['linkedin_url'] ?? null,
            'twitter_url' => $org['twitter_url'] ?? null,
            'facebook_url' => $org['facebook_url'] ?? null,
            'phone' => $org['phone'] ?? null,
            'technologies' => $org['technologies'] ?? [],
            'keywords' => $org['keywords'] ?? [],
        ];
    }
}
