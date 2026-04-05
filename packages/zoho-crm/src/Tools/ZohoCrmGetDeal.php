<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM deal by its ID.
 *
 * Returns the deal's full record including all populated fields.
 */
class ZohoCrmGetDeal implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_get_deal';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zoho CRM deal by its ID.
        Returns the deal record with all populated fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'deal_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM deal ID.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM deal by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (deal_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $id = $args['deal_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('deal_id is required.');
            }

            $result = $this->service->getDeal($id);
            $data = $result['data'] ?? [];

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
