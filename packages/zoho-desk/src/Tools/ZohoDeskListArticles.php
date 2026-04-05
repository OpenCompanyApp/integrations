<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_list_articles
 *
 * List knowledge base articles from Zoho Desk.
 */
class ZohoDeskListArticles implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_list_articles';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List knowledge base articles from Zoho Desk. Optionally filter by department or category.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'departmentId' => ['type' => 'string', 'description' => 'Filter articles by department ID.'],
            'categoryId' => ['type' => 'string', 'description' => 'Filter articles by category ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by article status (e.g., "Published", "Draft").'],
            'from' => ['type' => 'integer', 'description' => 'Pagination offset (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "title", "createdTime", "modifiedTime").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    /**
     * Execute the tool — list articles from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter([
                'departmentId' => $args['departmentId'] ?? null,
                'categoryId' => $args['categoryId'] ?? null,
                'status' => $args['status'] ?? null,
                'from' => $args['from'] ?? null,
                'limit' => $args['limit'] ?? null,
                'sortBy' => $args['sortBy'] ?? null,
                'sortOrder' => $args['sortOrder'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listArticles($params);

            $articles = $result['data'] ?? $result['articles'] ?? $result;

            return ToolResult::success(is_array($articles) ? $articles : [$articles]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
