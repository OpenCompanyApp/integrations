<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list email messages from a Zoho Mail account.
 *
 * Supports filtering by folder, pagination, and search.
 *
 * @see https://www.zoho.com/mail/help/api/getmails.html
 */
class ZohoMailListMessages implements Tool
{
    /**
     * Create a new ZohoMailListMessages tool instance.
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
        return 'zohomail_list_messages';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List email messages in a Zoho Mail folder. Returns message summaries including sender, subject, and date.';
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
            'folderId' => ['type' => 'string', 'description' => 'Folder ID to list messages from (default: Inbox).'],
            'start' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 20, max: 100).'],
            'searchKey' => ['type' => 'string', 'description' => 'Search query to filter messages.'],
        ];
    }

    /**
     * Execute the list messages tool.
     *
     * @param array<string, mixed> $args Tool arguments
     *
     * @return ToolResult The result containing message list or error
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

            $params = [];
            if (isset($args['folderId'])) {
                $params['folderId'] = $args['folderId'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }
            if (isset($args['searchKey'])) {
                $params['searchKey'] = $args['searchKey'];
            }

            $result = $this->service->listMessages($accountId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
