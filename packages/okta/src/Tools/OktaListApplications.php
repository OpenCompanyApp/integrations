<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaListApplications implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_list_applications';
    }

    public function description(): string
    {
        return 'List applications in the Okta organization. Returns application names, IDs, statuses, and types.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $apps = $this->service->listApplications();

            return ToolResult::success($apps);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
