<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a SOQL query against Salesforce.
 *
 * SOQL (Salesforce Object Query Language) is used to read records.
 * Example: SELECT Id, Name FROM Account LIMIT 10
 */
class SalesforceQuery implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_query';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a SOQL (Salesforce Object Query Language) query.
        Use SOQL to search records in Salesforce. Example: SELECT Id, Name FROM Account LIMIT 10
        Returns query results with total size and records.
        MD;
    }

    public function parameters(): array
    {
        return [
            'soql' => ['type' => 'string', 'required' => true, 'description' => 'SOQL query string (e.g. SELECT Id, Name FROM Account LIMIT 10).'],
        ];
    }

    /**
     * Execute a SOQL query and return results.
     *
     * @param  array<string, mixed>  $args  Tool arguments (soql)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $soql = $args['soql'] ?? '';
            if (empty($soql)) {
                return ToolResult::error('soql query is required.');
            }

            $result = $this->service->query($soql);

            return ToolResult::success([
                'totalSize' => $result['totalSize'] ?? 0,
                'done' => $result['done'] ?? true,
                'records' => $result['records'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
