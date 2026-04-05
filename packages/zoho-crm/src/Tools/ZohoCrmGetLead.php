<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM lead by its ID.
 *
 * Returns the lead's full record including all populated fields.
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
        Returns the lead record with all populated fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM lead ID.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM lead by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id)
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

            $result = $this->service->getLead($id);
            $data = $result['data'] ?? [];

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
