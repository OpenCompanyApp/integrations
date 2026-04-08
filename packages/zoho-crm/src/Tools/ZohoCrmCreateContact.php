<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Zoho CRM.
 *
 * Maps standard contact fields (first_name, last_name, email, phone) to Zoho CRM API
 * field names and wraps them in the Zoho data envelope.
 */
class ZohoCrmCreateContact implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new contact in Zoho CRM.
        Provide at least a last name. Other fields (first name, email, phone) are optional.
        Returns the created contact with its Zoho CRM ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
        ];
    }

    /**
     * Create a new Zoho CRM contact with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, email, phone)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $fields = [];

            if (! empty($args['last_name'])) {
                $fields['Last_Name'] = $args['last_name'];
            }
            if (! empty($args['first_name'])) {
                $fields['First_Name'] = $args['first_name'];
            }
            if (! empty($args['email'])) {
                $fields['Email'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $fields['Phone'] = $args['phone'];
            }

            if (empty($fields)) {
                return ToolResult::error('At least one contact field is required.');
            }

            $result = $this->service->createContact($fields);
            $data = $result['data'][0] ?? [];

            if (isset($data['code']) && $data['code'] !== 'SUCCESS') {
                return ToolResult::error($data['message'] ?? 'Failed to create contact.');
            }

            return ToolResult::success([
                'id' => $data['details']['id'] ?? '',
                'code' => $data['code'] ?? 'SUCCESS',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
