<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Continue a search using a cursor from a previous search call.
 */
class DropboxSearchContinue implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_search_continue';
    }

    public function description(): string
    {
        return 'Continue a search using the cursor from a previous dropbox_search_files or dropbox_search_continue call. Use when the previous response has has_more=true.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'required' => true, 'description' => 'The cursor returned by the previous search call.'],
        ];
    }

    /**
     * Continue a search with a pagination cursor.
     *
     * @param  array<string, mixed>  $args  Tool arguments (cursor)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $cursor = $args['cursor'] ?? '';

        if (empty($cursor)) {
            return ToolResult::error('A cursor is required.');
        }

        try {
            $result = $this->service->searchContinue(['cursor' => $cursor]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
