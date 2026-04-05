<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create one or more accounts in Zoho CRM.
 *
 * Accepts an array of account records wrapped in a data payload.
 */
class ZohoCrmCreateAccount implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_create_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Create one or more accounts in Zoho CRM.
        Each account record should include fields like Account_Name, Phone, Website, Industry, etc.
        Returns the created account records with their IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'data' => ['type' => 'array', 'description' => 'Array of account records. Each record is an object with Zoho CRM field names as keys (e.g. {"Account_Name": "Acme Corp", "Industry": "Technology"}).'],
        ];
    }

    /**
     * Create account(s) in Zoho CRM.
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
                return ToolResult::error('data is required and must be a non-empty array of account records.');
            }

            $result = $this->service->createAccount($data);

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
