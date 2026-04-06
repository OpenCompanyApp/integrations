<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackListPlans implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_list_plans';
    }

    public function description(): string
    {
        return 'List all membership plans configured in Memberstack. Returns plan IDs, names, pricing, and billing details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Memberstack integration is not configured.');
            }

            $result = $this->service->listPlans();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
