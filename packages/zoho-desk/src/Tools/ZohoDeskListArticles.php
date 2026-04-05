<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskListArticles implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_list_articles';
    }

    public function description(): string
    {
        return 'List knowledge base articles from Zoho Desk. Supports filtering by department, category, and search terms. Returns article IDs, titles, summaries, and categories.';
    }

    public function parameters(): array
    {
        return [
            'departmentId' => ['type' => 'string', 'description' => 'Filter by department ID.'],
            'categoryId' => ['type' => 'string', 'description' => 'Filter by article category ID.'],
            'from' => ['type' => 'integer', 'description' => 'Starting index for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of articles to return (default: 25, max: 200).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter articles by title or content.'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "title", "modifiedTime").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter($args, fn($value) => $value !== null && $value !== '');
            $result = $this->service->listArticles($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
