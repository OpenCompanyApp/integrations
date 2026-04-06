<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Loom folders with pagination support.
 *
 * Retrieves a paginated list of folders accessible to the authenticated user.
 * Supports limit and page parameters for controlling result size and pagination.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomListFolders implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_list_folders';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List Loom folders. Returns folder names, IDs, and video counts. Use limit and page for pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of folders to return (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the list folders API call.
     *
     * @param  array{limit?: int, page?: int}  $args  Optional pagination parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listFolders($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
