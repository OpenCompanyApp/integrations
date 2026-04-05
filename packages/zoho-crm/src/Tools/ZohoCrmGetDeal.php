<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM deal by ID.
 *
 * Returns the deal's fields.
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
        Returns all deal fields.
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

            $dealId = $args['deal_id'] ?? '';
            if (empty($dealId)) {
                return ToolResult::error('deal_id is required.');
            }

            $result = $this->service->getDeal($dealId);

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
