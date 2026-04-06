<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AbyssaleListTemplates implements Tool
{
    public function __construct(
        private AbyssaleService $service,
    ) {}

    public function name(): string
    {
        return 'abyssale_list_templates';
    }

    public function description(): string
    {
        return 'List available design templates from Abyssale. Returns a paginated list of templates with their IDs and names.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page (default: 20, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Abyssale integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listTemplates($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
