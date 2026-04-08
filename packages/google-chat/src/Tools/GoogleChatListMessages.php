<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleChatListMessages implements Tool
{
    public function __construct(
        private GoogleChatService $service,
    ) {}

    public function name(): string
    {
        return 'google_chat_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a Google Chat space. Returns message text, sender info, and creation timestamps. Supports pagination with pageSize and pageToken.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'Resource name of the space (e.g., "spaces/AAAAAAAAAAA").'],
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (1–1000, default 1000).'],
            'pageToken' => ['type' => 'string', 'description' => 'Page token from a previous list response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Chat integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 1000;
            $pageToken = $args['pageToken'] ?? null;

            $result = $this->service->listMessages($args['parent'], $pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
