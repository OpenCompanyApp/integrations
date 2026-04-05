<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Media
 *
 * Lists media library items from the WordPress REST API with pagination.
 */
class WordPressListMedia implements Tool
{
    /**
     * Create a new WordPressListMedia tool instance.
     */
    public function __construct(
        private WordPressService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'wordpress_list_media';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List media items from the WordPress media library. Returns file details including URL, type, and metadata.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page (1–100). Default: 10.'],
        ];
    }

    /**
     * Execute the list media tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 10;

            $result = $this->service->listMedia($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
