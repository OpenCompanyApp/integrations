<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_create_contact
 *
 * Creates a new contact (customer or vendor) in Zoho Books.
 * Requires at least a name; email and other details are optional.
 */
class ZohoBooksCreateContact implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_create_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new contact (customer or vendor) in Zoho Books. Requires a name; optionally provide email, phone, company name, and contact type.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Contact name (person or company).'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
            'company_name' => ['type' => 'string', 'description' => 'Company name (if different from contact name).'],
            'contact_type' => ['type' => 'string', 'description' => 'Contact type: customer, vendor (default: customer).'],
            'billing_address' => ['type' => 'object', 'description' => 'Billing address object with fields: attention, address, city, state, zip, country, phone.'],
            'shipping_address' => ['type' => 'object', 'description' => 'Shipping address object (same fields as billing_address).'],
            'notes' => ['type' => 'string', 'description' => 'Internal notes about this contact.'],
        ];
    }

    /**
     * Execute the tool call — create a contact in Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required to create a contact.');
            }

            $data = ['contact_name' => $name];

            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (isset($args['company_name'])) {
                $data['company_name'] = $args['company_name'];
            }
            if (isset($args['contact_type'])) {
                $data['contact_type'] = $args['contact_type'];
            }
            if (isset($args['billing_address'])) {
                $data['billing_address'] = $args['billing_address'];
            }
            if (isset($args['shipping_address'])) {
                $data['shipping_address'] = $args['shipping_address'];
            }
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }

            $result = $this->service->createContact($data);
            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'message' => 'Contact created successfully.',
                'contact' => $contact,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
