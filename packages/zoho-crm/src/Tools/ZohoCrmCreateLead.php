<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new lead in Zoho CRM.
 *
 * Maps standard lead fields (first_name, last_name, company, email, phone) to Zoho CRM
 * API field names (First_Name, Last_Name, Company, Email, Phone) and wraps them in the
 * Zoho {@code {"data": [...]}} request envelope.
 */
class ZohoCrmCreateLead implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_create_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new lead in Zoho CRM.
        Provide at least a last name or company name. Other fields (first name, email, phone) are optional.
        Returns the created lead with its Zoho CRM ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Lead first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Lead last name.'],
            'company' => ['type' => 'string', 'description' => 'Lead company name.'],
            'email' => ['type' => 'string', 'description' => 'Lead email address.'],
            'phone' => ['type' => 'string', 'description' => 'Lead phone number.'],
        ];
    }

    /**
     * Create a new Zoho CRM lead with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, company, email, phone)
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
            if (! empty($args['company'])) {
                $fields['Company'] = $args['company'];
            }
            if (! empty($args['email'])) {
                $fields['Email'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $fields['Phone'] = $args['phone'];
            }

            if (empty($fields)) {
                return ToolResult::error('At least one lead field is required.');
            }

            $result = $this->service->createLead($fields);
            $data = $result['data'][0] ?? [];

            if (isset($data['code']) && $data['code'] !== 'SUCCESS') {
                return ToolResult::error($data['message'] ?? 'Failed to create lead.');
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
