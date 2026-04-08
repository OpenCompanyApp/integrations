<?php

namespace OpenCompany\Integrations\FreeAgent\Tools;

use OpenCompany\Integrations\FreeAgent\FreeAgentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in FreeAgent.
 */
class FreeAgentCreateContact implements Tool
{
    /**
     * Create a new FreeAgentCreateContact tool instance.
     *
     * @param  FreeAgentService  $service  The FreeAgent service for making API calls.
     */
    public function __construct(
        private FreeAgentService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freeagent_create_contact';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new contact in FreeAgent. Contacts can be customers, suppliers, or employees. Provide at least a name (first_name/last_name for individuals or organisation_name for companies).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name (for individual contacts).'],
            'last_name' => ['type' => 'string', 'description' => 'Last name (for individual contacts).'],
            'organisation_name' => ['type' => 'string', 'description' => 'Company or organisation name (for company contacts).'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone_number' => ['type' => 'string', 'description' => 'Phone number.'],
            'contact_type' => ['type' => 'string', 'description' => 'Contact type: "Customer" (default) or "Supplier".'],
            'billing_email' => ['type' => 'string', 'description' => 'Email address for invoicing.'],
            'address1' => ['type' => 'string', 'description' => 'Address line 1.'],
            'address2' => ['type' => 'string', 'description' => 'Address line 2.'],
            'town' => ['type' => 'string', 'description' => 'Town or city.'],
            'region' => ['type' => 'string', 'description' => 'Region, state, or province.'],
            'postcode' => ['type' => 'string', 'description' => 'Postal or ZIP code.'],
            'country' => ['type' => 'string', 'description' => 'Country code (e.g., "GB", "US", "NL").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreeAgent integration is not configured.');
            }

            if (empty($args['first_name']) && empty($args['last_name']) && empty($args['organisation_name'])) {
                return ToolResult::error('At least a first_name, last_name, or organisation_name is required.');
            }

            $data = [];
            $fields = [
                'first_name', 'last_name', 'organisation_name', 'email', 'phone_number',
                'contact_type', 'billing_email', 'address1', 'address2', 'town',
                'region', 'postcode', 'country',
            ];

            foreach ($fields as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
