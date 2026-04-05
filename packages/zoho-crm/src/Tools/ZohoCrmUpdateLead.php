<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing lead in Zoho CRM.
 *
 * Accepts lead field data and optional trigger execution.
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
        Update an existing lead in Zoho CRM by its ID.
        Provide the fields to update as a data array with Zoho CRM field names as keys.
        Optionally specify triggers to execute (approval, workflow, blueprint).
        MD;
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM lead ID.'],
            'data' => ['type' => 'array', 'description' => 'Lead record fields to update. An array containing an object with Zoho CRM field names as keys (e.g. [{"First_Name": "Jane"}]).'],
            'trigger' => ['type' => 'array', 'description' => 'Triggers to execute. Possible values: "approval", "workflow", "blueprint".'],
        ];
    }

    /**
     * Update a Zoho CRM lead.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id, data, trigger)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $leadId = $args['lead_id'] ?? '';
            if (empty($leadId)) {
                return ToolResult::error('lead_id is required.');
            }

            $data = $args['data'] ?? [];
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $trigger = $args['trigger'] ?? null;

            $result = $this->service->updateLead(
                $leadId,
                $data,
                is_array($trigger) ? $trigger : null,
            );

            $records = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $records,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
