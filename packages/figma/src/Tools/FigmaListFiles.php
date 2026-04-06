<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Figma files accessible to the authenticated user.
 *
 * Returns a paginated list of files with name, key, and thumbnail.
 * Use limit and page to control pagination.
 */
class FigmaListFiles implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_list_files';
    }

    public function description(): string
    {
        return 'List Figma files accessible to the authenticated user. Returns file names, keys, and thumbnails with pagination support.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of files to return (default: 30).'],
            'page'  => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * List Figma files.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 30;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listFiles($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
