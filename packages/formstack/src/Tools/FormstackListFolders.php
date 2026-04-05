<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackListFolders — List all folders in the authenticated user's Formstack account.
 *
 * Returns a list of folders that can be used to organize forms.
 * Each folder includes its ID, name, and parent folder reference.
 *
 * @see https://www.formstack.com/docs/api/v2/folder#get-all-folders
 */
class FormstackListFolders implements Tool
{
    /**
     * @param  FormstackService  $service  The Formstack API service instance.
     */
    public function __construct(
        private FormstackService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'formstack_list_folders';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all folders in your Formstack account. Folders are used to organize forms.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list folders from Formstack.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $result = $this->service->listFolders();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
