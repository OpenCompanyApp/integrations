<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Salesforce lead.
 *
 * Accepts standard lead fields plus arbitrary custom fields via other_fields.
 */
class SalesforceUpdateLead implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_update_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Salesforce lead by ID.
        Supports FirstName, LastName, Company, Email, Phone, and additional custom fields via other_fields.
        Returns success confirmation on completion.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Salesforce lead ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Lead first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Lead last name.'],
            'company' => ['type' => 'string', 'description' => 'Lead company name.'],
            'email' => ['type' => 'string', 'description' => 'Lead email address.'],
            'phone' => ['type' => 'string', 'description' => 'Lead phone number.'],
            'other_fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs to merge into the request body.'],
        ];
    }

    /**
     * Update a Salesforce lead with new field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, first_name, last_name, company, email, phone, other_fields)
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

            $fields = [];

            if (! empty($args['first_name'])) {
                $fields['FirstName'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $fields['LastName'] = $args['last_name'];
            }
            if (! empty($args['company'])) {
                $fields['Company'] = $args['company'];
            }
            if (! empty($args['email'])) {
                $fields['Email'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $fields['Phone'] = $args['phone'];
            }

            if (isset($args['other_fields']) && is_array($args['other_fields'])) {
                foreach ($args['other_fields'] as $key => $value) {
                    $fields[$key] = $value;
                }
            }

            if (empty($fields)) {
                return ToolResult::error('At least one field is required to update.');
            }

            $this->service->updateLead($id, $fields);

            return ToolResult::success([
                'id' => $id,
                'updated' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
