<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneListApps implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_list_apps';
    }

    public function description(): string
    {
        return 'List available Kintone apps. Returns app IDs, names, and descriptions to help discover which apps are accessible.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of apps to return (default 100, max 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of apps to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $result = $this->service->listApps(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
