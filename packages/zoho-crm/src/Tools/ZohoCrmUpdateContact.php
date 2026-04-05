<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing contact in Zoho CRM.
 *
 * Accepts contact field data for updating an existing record.
 */
class ZohoCrmUpdateContact implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_update_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing contact in Zoho CRM by its ID.
        Provide the fields to update as a data array with Zoho CRM field names as keys.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM contact ID.'],
            'data' => ['type' => 'array', 'description' => 'Contact record fields to update. An array containing an object with Zoho CRM field names as keys (e.g. [{"First_Name": "Jane", "Email": "jane.new@example.com"}]).'],
        ];
    }

    /**
     * Update a Zoho CRM contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $data = $args['data'] ?? [];
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $result = $this->service->updateContact($contactId, $data);

            $records = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $records,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
