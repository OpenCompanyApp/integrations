<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Salesforce lead by ID.
 *
 * Returns the lead's fields and metadata.
 */
class SalesforceGetLead implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_get_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Salesforce lead by its ID.
        Returns the lead's fields, attributes, and associated data.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Salesforce lead ID (18 or 15 character).'],
        ];
    }

    /**
     * Retrieve a Salesforce lead by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getLead($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
