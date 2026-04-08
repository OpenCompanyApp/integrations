<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list email folders from a Zoho Mail account.
 *
 * Returns all folders including system folders (Inbox, Sent, Drafts, etc.)
 * and user-created folders, with folder IDs for use in other operations.
 *
 * @see https://www.zoho.com/mail/help/api/getfolders.html
 */
class ZohoMailListFolders implements Tool
{
    /**
     * Create a new ZohoMailListFolders tool instance.
     *
     * @param ZohoMailService $service The Zoho Mail service for API communication
     */
    public function __construct(
        private ZohoMailService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zohomail_list_folders';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all email folders in a Zoho Mail account, including Inbox, Sent, Drafts, Trash, and custom folders.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Mail account ID.'],
        ];
    }

    /**
     * Execute the list folders tool.
     *
     * @param array<string, mixed> $args Tool arguments
     *
     * @return ToolResult The result containing folder list or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            $accountId = $args['accountId'] ?? '';
            if (empty($accountId)) {
                return ToolResult::error('accountId is required.');
            }

            $result = $this->service->listFolders($accountId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
