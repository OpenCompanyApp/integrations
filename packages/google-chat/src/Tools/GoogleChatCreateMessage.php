<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleChatCreateMessage implements Tool
{
    public function __construct(
        private GoogleChatService $service,
    ) {}

    public function name(): string
    {
        return 'google_chat_create_message';
    }

    public function description(): string
    {
        return 'Send a message to a Google Chat space. Supports plain text and card-based rich messages (cardsV2). Either text or cardsV2 must be provided.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'Resource name of the space to send the message to (e.g., "spaces/AAAAAAAAAAA").'],
            'text' => ['type' => 'string', 'description' => 'Plain-text body of the message.'],
            'cardsV2' => ['type' => 'array', 'description' => 'Array of card widgets in Google Chat card v2 format for rich messages. Each entry must have a "cardId" and "card" with "sections".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Chat integration is not configured.');
            }

            $text = $args['text'] ?? null;
            $cardsV2 = $args['cardsV2'] ?? null;

            if ($text === null && $cardsV2 === null) {
                return ToolResult::error('Either text or cardsV2 must be provided.');
            }

            $result = $this->service->createMessage($args['parent'], $text, $cardsV2);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
