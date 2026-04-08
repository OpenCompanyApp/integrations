<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TapfiliateGetAffiliate implements Tool
{
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_get_affiliate';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific affiliate by their ID. Includes email, name, status, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The affiliate ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Affiliate ID is required.');
            }

            $result = $this->service->getAffiliate($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
