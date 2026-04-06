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
 * Endpoint: GET /people/search?title=…&company=…
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
            'title' => ['type' => 'string', 'description' => 'Job title to search for (e.g., "CEO", "Software Engineer", "VP of Sales").'],
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

            $title = $args['title'] ?? null;
            $company = $args['company'] ?? null;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            if (empty($title) && empty($company)) {
                return ToolResult::error('At least one of "title" or "company" is required.');
            }

            $result = $this->service->prospect($title, $company, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
