<?php

namespace OpenCompany\Integrations\Lokalise\Tools;

use OpenCompany\Integrations\Lokalise\LokaliseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LokaliseListKeys implements Tool
{
    public function __construct(
        private LokaliseService $service,
    ) {}

    public function name(): string
    {
        return 'lokalise_list_keys';
    }

    public function description(): string
    {
        return 'List translation keys in a Lokalise project. Returns key IDs, names, platforms, and other metadata. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of keys to return (default 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lokalise integration is not configured.');
            }

            $projectId = $args['project_id'];
            $limit = $args['limit'] ?? 25;
            $page = $args['page'] ?? 1;

            $result = $this->service->listKeys($projectId, $limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
