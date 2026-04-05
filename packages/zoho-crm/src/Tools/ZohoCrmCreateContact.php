<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create one or more contacts in Zoho CRM.
 *
 * Accepts an array of contact records wrapped in a data payload.
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
        Create one or more contacts in Zoho CRM.
        Each contact record should include fields like First_Name, Last_Name, Email, Phone, Mailing_Country, etc.
        Returns the created contact records with their IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'data' => ['type' => 'array', 'description' => 'Array of contact records. Each record is an object with Zoho CRM field names as keys (e.g. {"First_Name": "Jane", "Last_Name": "Smith", "Email": "jane@example.com"}).'],
        ];
    }

    /**
     * Create contact(s) in Zoho CRM.
     *
     * @param  array<string, mixed>  $args  Tool arguments (data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $data = $args['data'] ?? [];
            if (empty($data)) {
                return ToolResult::error('data is required and must be a non-empty array of contact records.');
            }

            $result = $this->service->createContact($data);

            $records = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $records,
                'count' => count($records),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
