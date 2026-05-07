<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Upsert Cursor repository blocklist patterns.
 */
class CursorUpsertRepoBlocklists implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_upsert_repo_blocklists';
    }

    public function description(): string
    {
        return 'Replace blocklist patterns for one or more Cursor team repositories.';
    }

    public function parameters(): array
    {
        return [
            'repos' => ['type' => 'array', 'required' => true, 'description' => 'Array of repository objects with url and patterns fields.'],
        ];
    }

    /**
     * Execute the tool and upsert repo blocklists.
     *
     * @param  array<string, mixed>  $args  Tool arguments (repos).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $repos = $args['repos'] ?? [];
            if (! is_array($repos) || empty($repos)) {
                return ToolResult::error('repos must be a non-empty array.');
            }

            return ToolResult::success($this->service->upsertRepoBlocklists($repos));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
