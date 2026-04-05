<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all available Salesforce objects.
 *
 * Returns a list of all standard and custom objects accessible by the user.
 */
class SalesforceListObjects implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_list_objects';
    }

    public function description(): string
    {
        return <<<'MD'
        List all available Salesforce objects (standard and custom).
        Returns object names, labels, and key prefixes.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all available Salesforce objects.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $result = $this->service->listObjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
