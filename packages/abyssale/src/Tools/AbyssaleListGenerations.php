<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AbyssaleListGenerations implements Tool
{
    public function __construct(
        private AbyssaleService $service,
    ) {}

    public function name(): string
    {
        return 'abyssale_list_generations';
    }

    public function description(): string
    {
        return 'List image generation jobs from Abyssale. Returns a paginated list of generations, optionally filtered by status (e.g., "finished", "processing", "failed").';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page (default: 20, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by generation status: "finished", "processing", or "failed".'],
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
            $status = $args['status'] ?? null;

            $result = $this->service->listGenerations($page, $limit, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
