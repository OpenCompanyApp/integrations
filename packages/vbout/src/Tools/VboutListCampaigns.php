<?php

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VboutListCampaigns implements Tool
{
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return 'vbout_list_campaigns';
    }

    public function description(): string
    {
        return 'List email campaigns from VBout. Returns paginated campaign records including subject, status, and send statistics.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of campaigns to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBout integration is not configured.');
            }

            $limit = min(isset($args['limit']) ? (int) $args['limit'] : 20, 100);
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listCampaigns($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
