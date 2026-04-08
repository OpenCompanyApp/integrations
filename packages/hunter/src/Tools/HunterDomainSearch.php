<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Search for email addresses associated with a domain using the Hunter.io API.
 */
class HunterDomainSearch implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_domain_search';
    }

    public function description(): string
    {
        return <<<'MD'
        Search for professional email addresses associated with a domain.
        Returns email addresses found for the company, along with contact names,
        positions, and social profiles. Supports filtering by email type (personal or generic).
        MD;
    }

    public function parameters(): array
    {
        return [
            'domain' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The domain to search (e.g., "example.com").',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of results to return (default: 10, max: 100).',
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Number of results to skip for pagination.',
            ],
            'type' => [
                'type' => 'string',
                'description' => 'Filter by email type: "personal" or "generic".',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Hunter integration is not configured.');
            }

            $domain = $args['domain'] ?? '';
            if (empty($domain)) {
                return ToolResult::error('The "domain" parameter is required.');
            }

            $result = $this->service->domainSearch(
                domain: $domain,
                limit: $args['limit'] ?? null,
                offset: $args['offset'] ?? null,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
