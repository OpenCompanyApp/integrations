<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsGetCustomer implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_get_customer';
    }

    public function description(): string
    {
        return 'Retrieve a single customer (contact) from Zoho Bills by ID. Returns full contact details including billing address and contact persons.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getCustomer($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
