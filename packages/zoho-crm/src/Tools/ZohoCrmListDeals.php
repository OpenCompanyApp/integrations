<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals from Zoho CRM with optional pagination.
 *
 * Supports page and per_page parameters for paginating through deal records.
 */
class ZohoCrmListDeals implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_list_deals';
    }

    public function description(): string
    {
        return <<<'MD'
        List deals from Zoho CRM with optional pagination.
        Use page and per_page to control pagination. Returns deal records.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page (default 20, max 200).'],
        ];
    }

    /**
     * List Zoho CRM deals with pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listDeals($params);
            $data = $result['data'] ?? [];

            return ToolResult::success([
                'results' => $data,
                'total' => count($data),
                'info' => $result['info'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
