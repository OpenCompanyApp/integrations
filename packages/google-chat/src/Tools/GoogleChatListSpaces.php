<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleChatListSpaces implements Tool
{
    public function __construct(
        private GoogleChatService $service,
    ) {}

    public function name(): string
    {
        return 'google_chat_list_spaces';
    }

    public function description(): string
    {
        return 'List Google Chat spaces the authenticated user belongs to. Returns space names, display names, and types. Supports pagination with pageSize and pageToken.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of spaces to return (1–1000, default 100).'],
            'pageToken' => ['type' => 'string', 'description' => 'Page token from a previous list response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Chat integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 100;
            $pageToken = $args['pageToken'] ?? null;

            $result = $this->service->listSpaces($pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
