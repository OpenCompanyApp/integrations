<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zendesk Help Center articles.
 */
class ZendeskSearchArticles implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_search_articles';
    }

    public function description(): string
    {
        return 'Search Zendesk Help Center articles by query. Optionally filter by section or category.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query string.'],
            'section' => ['type' => 'integer', 'description' => 'Filter results to a specific section ID.'],
            'category' => ['type' => 'integer', 'description' => 'Filter results to a specific category ID.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 25.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Search Help Center articles using a query string.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, section, category, per_page, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['query' => $query];

            if (isset($args['section'])) {
                $params['section'] = (int) $args['section'];
            }

            if (isset($args['category'])) {
                $params['category'] = (int) $args['category'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->searchArticles($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
