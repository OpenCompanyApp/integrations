<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Delete a Cursor repository blocklist entry.
 */
class CursorDeleteRepoBlocklist implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_delete_repo_blocklist';
    }

    public function description(): string
    {
        return 'Delete a repository blocklist entry from the Cursor team settings.';
    }

    public function parameters(): array
    {
        return [
            'repo_id' => ['type' => 'string', 'required' => true, 'description' => 'Repository blocklist ID to delete.'],
        ];
    }

    /**
     * Execute the tool and delete a repo blocklist.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repo_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $repoId = $args['repo_id'] ?? '';
            if (empty($repoId)) {
                return ToolResult::error('repo_id is required.');
            }

            return ToolResult::success($this->service->deleteRepoBlocklist((string) $repoId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
