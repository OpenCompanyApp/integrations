<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing lead in Zoho CRM.
 *
 * Maps standard fields (first_name, last_name, company, email, phone) to Zoho CRM API
 * field names and sends a PUT request wrapped in the Zoho data envelope.
 */
class ZohoCrmUpdateLead implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_update_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing lead in Zoho CRM.
        Provide the lead ID and the fields to update (first_name, last_name, company, email, phone).
        Returns the update status and modified lead details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM lead ID.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'company' => ['type' => 'string', 'description' => 'Updated company name.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
        ];
    }

    /**
     * Update a Zoho CRM lead with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id, first_name, last_name, company, email, phone)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $id = $args['lead_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('lead_id is required.');
            }

            $fields = [];

            if (array_key_exists('first_name', $args)) {
                $fields['First_Name'] = $args['first_name'];
            }
            if (array_key_exists('last_name', $args)) {
                $fields['Last_Name'] = $args['last_name'];
            }
            if (array_key_exists('company', $args)) {
                $fields['Company'] = $args['company'];
            }
            if (array_key_exists('email', $args)) {
                $fields['Email'] = $args['email'];
            }
            if (array_key_exists('phone', $args)) {
                $fields['Phone'] = $args['phone'];
            }

            if (empty($fields)) {
                return ToolResult::error('At least one field to update is required.');
            }

            $result = $this->service->updateLead($id, $fields);
            $data = $result['data'][0] ?? [];

            if (isset($data['code']) && $data['code'] !== 'SUCCESS') {
                return ToolResult::error($data['message'] ?? 'Failed to update lead.');
            }

            return ToolResult::success([
                'id' => $data['details']['id'] ?? $id,
                'code' => $data['code'] ?? 'SUCCESS',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
