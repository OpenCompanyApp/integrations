<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Salesforce account.
 *
 * Accepts standard account fields plus arbitrary custom fields via other_fields.
 */
class SalesforceUpdateAccount implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_update_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Salesforce account by ID.
        Supports Name, Website, Phone, and additional custom fields via other_fields.
        Returns success confirmation on completion.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Salesforce account ID to update.'],
            'name' => ['type' => 'string', 'description' => 'Account name.'],
            'website' => ['type' => 'string', 'description' => 'Account website URL.'],
            'phone' => ['type' => 'string', 'description' => 'Account phone number.'],
            'other_fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs to merge into the request body.'],
        ];
    }

    /**
     * Update a Salesforce account with new field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, website, phone, other_fields)
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

            if (! empty($args['name'])) {
                $fields['Name'] = $args['name'];
            }
            if (! empty($args['website'])) {
                $fields['Website'] = $args['website'];
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

            $this->service->updateAccount($id, $fields);

            return ToolResult::success([
                'id' => $id,
                'updated' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
