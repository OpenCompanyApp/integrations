<?php

namespace OpenCompany\Integrations\Salesforce\Tools;

use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Salesforce.
 *
 * Supports standard contact fields plus arbitrary custom fields via other_fields.
 */
class SalesforceCreateContact implements Tool
{
    /**
     * @param  SalesforceService  $service  The Salesforce API client
     */
    public function __construct(
        private SalesforceService $service,
    ) {}

    public function name(): string
    {
        return 'salesforce_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new contact in Salesforce.
        Supports FirstName, LastName, Email, Phone, AccountId, Title, and additional custom fields via other_fields.
        Returns the created contact ID and success status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Contact last name.'],
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'account_id' => ['type' => 'string', 'description' => 'Salesforce Account ID to associate the contact with.'],
            'title' => ['type' => 'string', 'description' => 'Contact job title.'],
            'other_fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs to merge into the request body.'],
        ];
    }

    /**
     * Create a new Salesforce contact with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, email, phone, account_id, title, other_fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Salesforce integration is not configured.');
            }

            $fields = [];

            if (! empty($args['first_name'])) {
                $fields['FirstName'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $fields['LastName'] = $args['last_name'];
            }
            if (! empty($args['email'])) {
                $fields['Email'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $fields['Phone'] = $args['phone'];
            }
            if (! empty($args['account_id'])) {
                $fields['AccountId'] = $args['account_id'];
            }
            if (! empty($args['title'])) {
                $fields['Title'] = $args['title'];
            }

            if (isset($args['other_fields']) && is_array($args['other_fields'])) {
                foreach ($args['other_fields'] as $key => $value) {
                    $fields[$key] = $value;
                }
            }

            if (empty($fields['LastName'])) {
                return ToolResult::error('last_name is required.');
            }

            $result = $this->service->createContact($fields);

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
