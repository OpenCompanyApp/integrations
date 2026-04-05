<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaListGroups implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_list_groups';
    }

    public function description(): string
    {
        return 'List groups in the Okta organization. Returns group names and IDs. Supports search filtering by group name.';
    }

    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'description' => 'Search query to filter groups by name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $q = $args['q'] ?? null;

            $groups = $this->service->listGroups($q);

            return ToolResult::success($groups);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
