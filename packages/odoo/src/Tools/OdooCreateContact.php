<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a new contact in Odoo.
 *
 * Creates a new contact (res.partner) record with the provided data.
 * Supports creating both individual and company contacts.
 */
class OdooCreateContact implements Tool
{
    /**
     * @param  OdooService  $service  The Odoo service instance for making API calls.
     */
    public function __construct(
        private OdooService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'odoo_create_contact';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new contact (customer or vendor) in Odoo. Supports individuals and companies.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Full name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Email address.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
            'is_company' => ['type' => 'boolean', 'description' => 'Whether this is a company record (default: false).'],
            'company_type' => ['type' => 'string', 'description' => '"company" or "person" (default: "person").'],
            'street' => ['type' => 'string', 'description' => 'Street address.'],
            'city' => ['type' => 'string', 'description' => 'City.'],
            'zip' => ['type' => 'string', 'description' => 'Postal / ZIP code.'],
            'country' => ['type' => 'string', 'description' => 'Country name or code.'],
            'website' => ['type' => 'string', 'description' => 'Website URL.'],
            'vat' => ['type' => 'string', 'description' => 'Tax ID / VAT number.'],
            'type' => ['type' => 'string', 'description' => 'Contact type: "contact", "invoice", "delivery", or "other" (default: "contact").'],
            'parent_id' => ['type' => 'integer', 'description' => 'Parent company ID for subsidiary contacts.'],
            'function' => ['type' => 'string', 'description' => 'Job position / title.'],
        ];
    }

    /**
     * Execute the tool — create a new contact in Odoo.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Odoo integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Contact name is required.');
            }

            $data = [];

            // Required fields
            $data['name'] = $args['name'];

            // Optional string fields
            foreach (['email', 'phone', 'street', 'city', 'zip', 'country', 'website', 'vat', 'type', 'function'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            // Optional boolean fields
            if (isset($args['is_company'])) {
                $data['is_company'] = (bool) $args['is_company'];
            }

            // Optional company_type
            if (isset($args['company_type'])) {
                $data['company_type'] = $args['company_type'];
            }

            // Optional integer fields
            if (isset($args['parent_id'])) {
                $data['parent_id'] = (int) $args['parent_id'];
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
