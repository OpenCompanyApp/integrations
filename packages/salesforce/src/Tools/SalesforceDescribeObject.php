<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Describe metadata for a Salesforce object type.
 *
 * Returns field definitions, relationships, and other metadata for the specified object.
 */
class SalesforceDescribeObject implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_describe_object';
    }

    public function description(): string
    {
        return <<<'MD'
        Get metadata for a Salesforce object type.
        Returns field definitions, relationships, record types, and other metadata.
        Example object types: Account, Contact, Lead, Opportunity, Case, Task, User.
        MD;
    }

    public function parameters(): array
    {
        return [
            'object_type' => ['type' => 'string', 'required' => true, 'description' => 'Salesforce object API name (e.g. Account, Contact, Lead).'],
        ];
    }

    /**
     * Describe a Salesforce object type and return its metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments (object_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $objectType = $args['object_type'] ?? '';
            if (empty($objectType)) {
                return ToolResult::error('object_type is required.');
            }

            $result = $this->service->describeObject($objectType);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
