<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneListSpaces implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_list_spaces';
    }

    public function description(): string
    {
        return 'List Kintone spaces. Spaces are collaborative workspaces that contain apps, threads, and other resources.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of spaces to return (default 100, max 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of spaces to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $result = $this->service->listSpaces(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
