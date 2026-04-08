<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubListDomains implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_list_domains';
    }

    public function description(): string
    {
        return 'List all domains configured in your Dub.co workspace.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->listDomains(
                page: isset($args['page']) ? (int) $args['page'] : 1,
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : 50,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
