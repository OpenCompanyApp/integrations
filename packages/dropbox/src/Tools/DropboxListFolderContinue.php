<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Continue listing files and folders using a cursor from a previous list_folder call.
 */
class DropboxListFolderContinue implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_list_folder_continue';
    }

    public function description(): string
    {
        return 'Continue listing files and folders using the cursor from a previous dropbox_list_folder or dropbox_list_folder_continue call. Use this when the previous response has has_more=true.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'required' => true, 'description' => 'The cursor returned by the previous list_folder or list_folder_continue call.'],
        ];
    }

    /**
     * Continue listing with a pagination cursor.
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
            $result = $this->service->listFolderContinue(['cursor' => $cursor]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
