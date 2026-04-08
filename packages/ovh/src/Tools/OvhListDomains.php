<?php

namespace OpenCompany\Integrations\Ovh\Tools;

use OpenCompany\Integrations\Ovh\OvhService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OvhListDomains implements Tool
{
    public function __construct(
        private OvhService $service,
    ) {}

    public function name(): string
    {
        return 'ovh_list_domains';
    }

    public function description(): string
    {
        return 'List all domains in the OVH account. Returns a list of domain names.';
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

            $result = $this->service->listDomains();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
