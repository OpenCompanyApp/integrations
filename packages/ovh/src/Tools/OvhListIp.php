<?php

namespace OpenCompany\Integrations\Ovh\Tools;

use OpenCompany\Integrations\Ovh\OvhService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OvhListIp implements Tool
{
    public function __construct(
        private OvhService $service,
    ) {}

    public function name(): string
    {
        return 'ovh_list_ip';
    }

    public function description(): string
    {
        return 'List all IP addresses in the OVH account. Returns a list of IP blocks and addresses.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OVH integration is not configured.');
            }

            $result = $this->service->listIp();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
