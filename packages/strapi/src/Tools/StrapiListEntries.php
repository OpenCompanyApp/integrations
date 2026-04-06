<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiListEntries implements Tool
{
    /**
     * Create a new StrapiListEntries tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_list_entries';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List entries for a content type in Strapi. Supports pagination, sorting, and field population (relations, media, components).';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'required' => true, 'description' => 'The API ID of the content type (e.g., "article", "page", "product").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of entries per page (default: 25).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field and direction (e.g., "createdAt:desc", "title:asc").'],
            'populate' => ['type' => 'string', 'description' => 'Relations to populate. Use "*" for all, or a specific field name (e.g., "author", "image").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Strapi integration is not configured.');
            }

            $contentType = $args['content_type'];
            $params = [];

            if (isset($args['page'])) {
                $params['pagination[page]'] = (int) $args['page'];
            }

            if (isset($args['page_size'])) {
                $params['pagination[pageSize]'] = (int) $args['page_size'];
            }

            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            if (isset($args['populate'])) {
                $params['populate'] = $args['populate'];
            }

            $result = $this->service->listEntries($contentType, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
