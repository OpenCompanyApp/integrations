<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebexCreateMessage implements Tool
{
    public function __construct(
        private WebexService $service,
    ) {}

    public function name(): string
    {
        return 'webex_create_message';
    }

    public function description(): string
    {
        return 'Post a new message to a Webex room. Supports plain text and Markdown formatting. Provide either "text" (plain text) or "markdown" (formatted), or both — Webex will display Markdown to clients that support it and fall back to plain text.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The room to post the message in.'],
            'text' => ['type' => 'string', 'description' => 'Plain-text content of the message.'],
            'markdown' => ['type' => 'string', 'description' => 'Markdown-formatted content of the message.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webex integration is not configured.');
            }

            $roomId = $args['room_id'] ?? '';
            if (empty($roomId)) {
                return ToolResult::error('room_id is required.');
            }

            $text = $args['text'] ?? null;
            $markdown = $args['markdown'] ?? null;

            if ($text === null && $markdown === null) {
                return ToolResult::error('Either "text" or "markdown" must be provided.');
            }

            $result = $this->service->createMessage($roomId, $text, $markdown);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
