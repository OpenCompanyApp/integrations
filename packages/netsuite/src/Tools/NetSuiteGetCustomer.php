<?php

namespace OpenCompany\Integrations\NetSuite\Tools;

use OpenCompany\Integrations\NetSuite\NetSuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetSuiteGetCustomer implements Tool
{
    /**
     * Create a new NetSuiteGetCustomer tool instance.
     */
    public function __construct(
        private NetSuiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'netsuite_get_customer';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get detailed information for a single NetSuite customer by internal ID. Returns full customer record including contact details, addresses, and financial information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The internal ID of the customer in NetSuite.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NetSuite integration is not configured.');
            }

            $id = $args['id'];
            $result = $this->service->getCustomer($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
