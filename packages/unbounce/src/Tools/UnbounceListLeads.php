<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class UnbounceListLeads implements Tool
{
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_list_leads';
    }

    public function description(): string
    {
        return 'List form submissions (leads) for a specific Unbounce landing page. Returns lead data including form field values, submission timestamps, and conversion details.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The Unbounce page ID to list leads for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of leads to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listLeads($args['page_id'], $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
