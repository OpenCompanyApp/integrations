<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a Gotify notification with an application token.
 */
class GotifyCreateMessage implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_create_message';
    }

    public function description(): string
    {
        return 'Send a notification message via Gotify. The message body supports Markdown formatting. Use priority 0–4 for low, 5 for normal, and 6–10 for high priority.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Message title.'],
            'message' => ['type' => 'string', 'required' => true, 'description' => 'Message body (supports Markdown).'],
            'priority' => ['type' => 'integer', 'description' => 'Message priority from 0 (lowest) to 10 (highest). Default is 5 (normal).'],
            'extras' => ['type' => 'object', 'description' => 'Optional Gotify message extras, such as client::display contentType.'],
        ];
    }

    /**
     * Send a notification through Gotify.
     *
     * @param  array<string, mixed>  $args  Tool arguments (title, message, priority, extras).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gotify integration is not configured.');
            }

            $title = $args['title'] ?? '';
            $message = $args['message'] ?? '';
            $priority = isset($args['priority']) ? (int) $args['priority'] : 5;

            if ($message === '') {
                return ToolResult::error('message is required.');
            }

            if ($priority < 0 || $priority > 10) {
                return ToolResult::error('Priority must be between 0 and 10.');
            }

            $extras = is_array($args['extras'] ?? null) ? $args['extras'] : [];
            $result = $this->service->createMessage($title, $message, $priority, $extras);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
