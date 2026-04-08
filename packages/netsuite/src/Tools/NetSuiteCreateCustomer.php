<?php

namespace OpenCompany\Integrations\NetSuite\Tools;

use OpenCompany\Integrations\NetSuite\NetSuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetSuiteCreateCustomer implements Tool
{
    /**
     * Create a new NetSuiteCreateCustomer tool instance.
     */
    public function __construct(
        private NetSuiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'netsuite_create_customer';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new customer in NetSuite ERP. Provide at minimum the company name or first/last name. Additional fields like email, phone, subsidiary, and address can be included.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'companyname' => ['type' => 'string', 'description' => 'Company name for the customer (required for company customers).'],
            'firstname' => ['type' => 'string', 'description' => 'First name (required for individual customers).'],
            'lastname' => ['type' => 'string', 'description' => 'Last name (required for individual customers).'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Primary phone number.'],
            'subsidiary' => ['type' => 'string', 'description' => 'Subsidiary internal ID or ref (required for OneWorld accounts).'],
            'entitystatus' => ['type' => 'string', 'description' => 'Customer status (e.g., "CUSTOMER-Closed", "CUSTOMER-Lost").'],
            'currency' => ['type' => 'string', 'description' => 'Currency internal ID or ref (e.g., "1" for USD).'],
            'terms' => ['type' => 'string', 'description' => 'Payment terms internal ID or ref.'],
            'addressbook' => ['type' => 'array', 'description' => 'Array of address objects with addr1, city, state, zip, country fields.'],
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

            if (empty($args['companyname']) && empty($args['lastname'])) {
                return ToolResult::error('Either companyname or lastname is required to create a customer.');
            }

            $result = $this->service->createCustomer($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
