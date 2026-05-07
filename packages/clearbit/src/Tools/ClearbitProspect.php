<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_prospect
 *
 * Searches for people by job title and/or company name using the Clearbit
 * Prospecting API. Returns lists of matching people with names, titles,
 * and email addresses when available.
 *
 * Endpoint: GET https://prospector.clearbit.com/v1/people/search
 */
class ClearbitProspect implements Tool
{
    /**
     * @param  ClearbitService  $service  The Clearbit API service instance.
     */
    public function __construct(
        private ClearbitService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'clearbit_prospect';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Find people by job title and/or company name using Clearbit Prospecting. Returns names, titles, and email addresses when available.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'description' => 'Company domain to search within (e.g., "example.test").'],
            'title' => ['type' => 'string', 'description' => 'Job title to search for (e.g., "CEO", "Software Engineer", "VP of Sales").'],
            'role' => ['type' => 'string', 'description' => 'Role filter such as sales or engineering.'],
            'roles' => ['type' => 'string', 'description' => 'Comma-separated role filters.'],
            'seniority' => ['type' => 'string', 'description' => 'Seniority filter such as executive, manager, or individual_contributor.'],
            'company' => ['type' => 'string', 'description' => 'Company name to filter by (e.g., "Stripe", "Google").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the prospecting search.
     *
     * @param  array<string, mixed>  $args  Tool arguments — at least one of 'title' or 'company' should be provided.
     * @return ToolResult The list of matching people or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $params = array_filter([
                'domain' => $args['domain'] ?? null,
                'title' => $args['title'] ?? null,
                'role' => $args['role'] ?? null,
                'roles' => $args['roles'] ?? null,
                'seniority' => $args['seniority'] ?? null,
                'company' => $args['company'] ?? null,
                'page' => isset($args['page']) ? (int) $args['page'] : 1,
            ], static fn ($value) => $value !== null && $value !== '');

            if (count($params) === 1 && isset($params['page'])) {
                return ToolResult::error('At least one filter such as domain, title, role, seniority, or company is required.');
            }

            $result = $this->service->prospect($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
