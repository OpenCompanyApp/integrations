<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create one or more leads in Zoho CRM.
 *
 * Accepts an array of lead records wrapped in a data payload, with optional trigger
 * execution and duplicate check fields.
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
        Create one or more leads in Zoho CRM.
        Each lead record should include fields like First_Name, Last_Name, Company, Email, Phone, etc.
        Optionally specify triggers to execute (approval, workflow, blueprint) and duplicate check fields.
        Returns the created lead records with their IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'data' => ['type' => 'array', 'description' => 'Array of lead records. Each record is an object with Zoho CRM field names as keys (e.g. {"First_Name": "John", "Last_Name": "Doe", "Company": "Acme"}).'],
            'trigger' => ['type' => 'array', 'description' => 'Triggers to execute. Possible values: "approval", "workflow", "blueprint".'],
            'duplicate_check_fields' => ['type' => 'array', 'description' => 'Field API names used for duplicate checking (e.g. ["Email", "Phone"]).'],
        ];
    }

    /**
     * Create lead(s) in Zoho CRM.
     *
     * @param  array<string, mixed>  $args  Tool arguments (data, trigger, duplicate_check_fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $data = $args['data'] ?? [];
            if (empty($data)) {
                return ToolResult::error('data is required and must be a non-empty array of lead records.');
            }

            $trigger = $args['trigger'] ?? null;
            $duplicateCheckFields = $args['duplicate_check_fields'] ?? null;

            $result = $this->service->createLead(
                $data,
                is_array($trigger) ? $trigger : null,
                is_array($duplicateCheckFields) ? $duplicateCheckFields : null,
            );

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
