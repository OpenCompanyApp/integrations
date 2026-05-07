<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Granola\GranolaService;

/**
 * List accessible Granola folders.
 *
 * Returns folder hierarchy metadata from the official Granola Enterprise API.
 */
class GranolaListFolders implements Tool
{
    /**
     * @param  GranolaService  $service  The Granola API client.
     */
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_list_folders';
    }

    public function description(): string
    {
        return 'List accessible Granola folders with cursor pagination.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of folders to return, from 1 to 30.'],
        ];
    }

    /**
     * List folders.
     *
     * @param  array<string, mixed>  $args  Optional pagination arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            return ToolResult::success($this->service->listFolders($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
