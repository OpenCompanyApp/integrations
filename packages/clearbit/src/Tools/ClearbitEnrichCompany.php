<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_enrich_company
 *
 * Enriches a company record by looking up its domain name via the Clearbit
 * Enrichment API (Company API). Returns company metrics, industry
 * categorization, social profiles, and funding data when available.
 *
 * Endpoint: GET /companies/find?domain=…
 */
class ClearbitEnrichCompany implements Tool
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
        return 'clearbit_enrich_company';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Look up a company by domain name using Clearbit. Returns company metrics, industry categorization, social profiles, and funding data when available.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'required' => true, 'description' => 'The company domain to look up (e.g., "stripe.com").'],
        ];
    }

    /**
     * Execute the company enrichment lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'domain'.
     * @return ToolResult The enriched company data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $domain = $args['domain'] ?? '';
            if (empty($domain)) {
                return ToolResult::error('A domain name is required.');
            }

            $result = $this->service->enrichCompany($domain);

            if (empty($result)) {
                return ToolResult::success([
                    'domain' => $domain,
                    'found' => false,
                    'message' => 'No company data found for this domain.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
