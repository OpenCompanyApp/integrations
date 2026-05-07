<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * List Cursor repository blocklists.
 */
class CursorListRepoBlocklists implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_list_repo_blocklists';
    }

    public function description(): string
    {
        return 'List repository blocklists configured for the Cursor team.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return repo blocklists.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            return ToolResult::success($this->service->listRepoBlocklists());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
