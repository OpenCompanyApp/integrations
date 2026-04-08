<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleChatGetMessage implements Tool
{
    public function __construct(
        private GoogleChatService $service,
    ) {}

    public function name(): string
    {
        return 'google_chat_get_message';
    }

    public function description(): string
    {
        return 'Get a specific message from a Google Chat space. Returns the full message including text, cards, sender, and annotations.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'Resource name of the space (e.g., "spaces/AAAAAAAAAAA").'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Resource name of the message, relative to the space (e.g., "messages/BBBBBBBBBBB").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Chat integration is not configured.');
            }

            $result = $this->service->getMessage($args['parent'], $args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
