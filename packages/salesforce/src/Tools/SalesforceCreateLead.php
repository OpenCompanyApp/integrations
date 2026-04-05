<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new lead in Salesforce.
 *
 * Supports standard lead fields plus arbitrary custom fields via other_fields.
 */
class SalesforceCreateLead implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new lead in Salesforce.
        Supports FirstName, LastName, Company, Email, Phone, Title, Website, and additional custom fields via other_fields.
        Returns the created lead ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Lead first name.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Lead last name.'],
            'company' => ['type' => 'string', 'required' => true, 'description' => 'Lead company name.'],
            'email' => ['type' => 'string', 'description' => 'Lead email address.'],
            'phone' => ['type' => 'string', 'description' => 'Lead phone number.'],
            'title' => ['type' => 'string', 'description' => 'Lead job title.'],
            'website' => ['type' => 'string', 'description' => 'Lead website URL.'],
            'other_fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs to merge into the request body.'],
        ];
    }

    /**
     * Create a new Salesforce lead with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, company, email, phone, title, website, other_fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $fields = [];

            if (! empty($args['last_name'])) {
                $fields['LastName'] = $args['last_name'];
            }
            if (! empty($args['first_name'])) {
                $fields['FirstName'] = $args['first_name'];
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
            if (! empty($args['title'])) {
                $fields['Title'] = $args['title'];
            }
            if (! empty($args['website'])) {
                $fields['Website'] = $args['website'];
            }

            if (isset($args['other_fields']) && is_array($args['other_fields'])) {
                foreach ($args['other_fields'] as $key => $value) {
                    $fields[$key] = $value;
                }
            }

            if (empty($fields['LastName']) || empty($fields['Company'])) {
                return ToolResult::error('last_name and company are required.');
            }

            $result = $this->service->createLead($fields);

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
