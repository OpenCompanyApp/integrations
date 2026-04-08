<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Keap CRM.
 *
 * Accepts first name, last name, email, and company name. The email
 * is added as the primary email address for the contact. Returns the
 * newly created contact with its assigned ID.
 */
class KeapCreateContact implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Keap CRM. Provide at least a first name or last name. Email and company name are optional.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address for the contact.'],
            'company_name' => ['type' => 'string', 'description' => 'Company name to associate with the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['given_name'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $data['family_name'] = $args['last_name'];
            }

            if (isset($args['email'])) {
                $data['email_addresses'] = [
                    [
                        'email' => $args['email'],
                        'field' => 'EMAIL1',
                    ],
                ];
            }

            if (isset($args['company_name'])) {
                $data['company'] = [
                    'company_name' => $args['company_name'],
                ];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field (first_name, last_name, email, or company_name) is required.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
