<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all folders in a Cloudinary cloud.
 *
 * Returns the folder hierarchy with pagination support.
 */
class CloudinaryListFolders implements Tool
{
    /**
     * Create a new CloudinaryListFolders tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_list_folders';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all folders in your Cloudinary cloud. Returns folder names and paths with pagination support.';
    }

    /**
     * Parameter schema for the list-folders tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of folders to return (default 10).'],
            'next_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the list-folders request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudinary integration is not configured.');
            }

            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : null;
            $nextCursor = $args['next_cursor'] ?? null;

            $result = $this->service->listFolders($nextCursor, $maxResults);

            return ToolResult::success([
                'folders' => $result['folders'] ?? [],
                'total_count' => $result['total_count'] ?? null,
                'next_cursor' => $result['next_cursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
