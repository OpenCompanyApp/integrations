<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_list_autocomplete
 *
 * Searches for companies by name using the Clearbit Autocomplete API.
 * Ideal for type-ahead / autocomplete UI flows where users start typing
 * a company name and get suggestions back.
 *
 * Endpoint: GET /companies/find?name=…
 */
class ClearbitListAutocomplete implements Tool
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
        return 'clearbit_list_autocomplete';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Search for companies by name using Clearbit Autocomplete. Returns a list of matching companies with domains, logos, and descriptions. Useful for type-ahead search.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Company name or prefix to search for (e.g., "Stripe", "Goo").'],
        ];
    }

    /**
     * Execute the company autocomplete search.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'name'.
     * @return ToolResult The list of matching companies or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('A company name is required.');
            }

            $result = $this->service->autocomplete($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
