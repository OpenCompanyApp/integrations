<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recently accessed items in Salesforce.
 *
 * Returns a list of recently viewed or modified records across all objects.
 */
class SalesforceListRecent implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_list_recent';
    }

    public function description(): string
    {
        return <<<'MD'
        List recently accessed items in Salesforce.
        Returns recently viewed or modified records across all object types.
        Optionally specify a limit to control the number of items returned.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default 25).'],
        ];
    }

    /**
     * List recently accessed Salesforce items.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;

            $result = $this->service->listRecent($limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
