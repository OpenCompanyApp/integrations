<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a SOSL search across Salesforce.
 *
 * SOSL (Salesforce Object Search Language) is used for text-based searches across multiple objects.
 * Example: FIND {test} IN ALL FIELDS RETURNING Account(Id, Name)
 */
class SalesforceSearch implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_search';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a SOSL (Salesforce Object Search Language) search.
        Use SOSL for text-based searches across multiple object types. Example: FIND {test} IN ALL FIELDS RETURNING Account(Id, Name)
        Returns search results grouped by object type.
        MD;
    }

    public function parameters(): array
    {
        return [
            'sosl' => ['type' => 'string', 'required' => true, 'description' => 'SOSL search string (e.g. FIND {test} IN ALL FIELDS RETURNING Account(Id, Name)).'],
        ];
    }

    /**
     * Execute a SOSL search and return results.
     *
     * @param  array<string, mixed>  $args  Tool arguments (sosl)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $sosl = $args['sosl'] ?? '';
            if (empty($sosl)) {
                return ToolResult::error('sosl search string is required.');
            }

            $result = $this->service->search($sosl);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
