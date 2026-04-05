<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM lead by ID.
 *
 * Returns the lead's fields and optionally limits the response to specific fields.
 */
class ZohoCrmGetLead implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_get_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zoho CRM lead by its ID.
        Returns all lead fields by default, or specify a list of field API names to include.
        MD;
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM lead ID.'],
            'fields' => ['type' => 'array', 'description' => 'List of field API names to include in the response.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM lead by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id, fields)
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

            $fields = $args['fields'] ?? null;
            $result = $this->service->getLead($leadId, is_array($fields) ? $fields : null);

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
