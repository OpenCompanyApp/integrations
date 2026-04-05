<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a Discord webhook to send a message.
 *
 * Webhooks use their own token in the URL and do not require bot authentication.
 */
class DiscordSendWebhook implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_send_webhook';
    }

    public function description(): string
    {
        return 'Execute a Discord webhook to send a message. Does not require bot authentication.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id'     => ['type' => 'string', 'required' => true, 'description' => 'The ID of the webhook.'],
            'webhook_token'  => ['type' => 'string', 'required' => true, 'description' => 'The token of the webhook.'],
            'content'        => ['type' => 'string', 'description' => 'The text content of the message.'],
            'embeds'         => ['type' => 'string', 'description' => 'JSON array of embed objects for rich formatting.'],
            'username'       => ['type' => 'string', 'description' => 'Override the default webhook username.'],
            'avatar_url'     => ['type' => 'string', 'description' => 'Override the default webhook avatar with a URL.'],
        ];
    }

    /**
     * Execute a webhook to send a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (webhook_id, webhook_token, content, embeds, username, avatar_url)
     */
    public function execute(array $args): ToolResult
    {
        try {
            $webhookId = $args['webhook_id'] ?? '';
            $webhookToken = $args['webhook_token'] ?? '';

            if (empty($webhookId)) {
                return ToolResult::error('webhook_id is required.');
            }
            if (empty($webhookToken)) {
                return ToolResult::error('webhook_token is required.');
            }
            if (empty($args['content']) && empty($args['embeds'])) {
                return ToolResult::error('content or embeds is required.');
            }

            $data = [];

            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }
            if (isset($args['embeds'])) {
                $embeds = $args['embeds'];
                $data['embeds'] = is_string($embeds) ? json_decode($embeds, true) : $embeds;
            }
            if (isset($args['username'])) {
                $data['username'] = $args['username'];
            }
            if (isset($args['avatar_url'])) {
                $data['avatar_url'] = $args['avatar_url'];
            }

            $result = $this->service->sendWebhook($webhookId, $webhookToken, $data);

            return ToolResult::success([
                'ok' => true,
                'webhook_id' => $webhookId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
