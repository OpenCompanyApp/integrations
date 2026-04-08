<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new account in Salesforce.
 *
 * Supports standard account fields plus arbitrary custom fields via other_fields.
 */
class SalesforceCreateAccount implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new account in Salesforce.
        Supports Name, Website, Phone, Industry, BillingCity, BillingCountry, and additional custom fields via other_fields.
        Returns the created account ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Account name.'],
            'website' => ['type' => 'string', 'description' => 'Account website URL.'],
            'phone' => ['type' => 'string', 'description' => 'Account phone number.'],
            'industry' => ['type' => 'string', 'description' => 'Account industry (e.g. Technology, Finance).'],
            'billing_city' => ['type' => 'string', 'description' => 'Billing address city.'],
            'billing_country' => ['type' => 'string', 'description' => 'Billing address country.'],
            'other_fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs to merge into the request body.'],
        ];
    }

    /**
     * Create a new Salesforce account with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, website, phone, industry, billing_city, billing_country, other_fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
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
            if (! empty($args['industry'])) {
                $fields['Industry'] = $args['industry'];
            }
            if (! empty($args['billing_city'])) {
                $fields['BillingCity'] = $args['billing_city'];
            }
            if (! empty($args['billing_country'])) {
                $fields['BillingCountry'] = $args['billing_country'];
            }

            if (isset($args['other_fields']) && is_array($args['other_fields'])) {
                foreach ($args['other_fields'] as $key => $value) {
                    $fields[$key] = $value;
                }
            }

            if (empty($fields['Name'])) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->createAccount($fields);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'success' => $result['success'] ?? true,
                'errors' => $result['errors'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
