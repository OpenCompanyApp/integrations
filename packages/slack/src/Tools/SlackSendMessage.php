<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a message to a Slack channel or DM.
 *
 * Supports text formatting, Block Kit blocks, thread replies,
 * and link unfurling.
 */
class SlackSendMessage implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_send_message';
    }

    public function description(): string
    {
        return 'Send a message to a Slack channel or DM. Supports text, blocks, and thread replies.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID or name (e.g., "#general" or "C12345678").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Message text.'],
            'blocks' => ['type' => 'string', 'description' => 'JSON array of Slack Block Kit blocks for rich formatting.'],
            'thread_ts' => ['type' => 'string', 'description' => 'Timestamp of the parent message to reply in a thread.'],
            'reply_broadcast' => ['type' => 'boolean', 'description' => 'If true, also post the reply to the channel (thread_ts required).'],
            'unfurl_links' => ['type' => 'boolean', 'description' => 'If true, enable unfurling of links.'],
            'markdown' => ['type' => 'boolean', 'description' => 'If true, enable mrkdwn formatting in text.'],
        ];
    }

    /**
     * Send a message to a channel or user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, text, blocks, thread_ts, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $text = $args['text'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($text) && empty($args['blocks'])) {
                return ToolResult::error('text or blocks is required.');
            }

            $data = [
                'channel' => $channel,
                'text' => $text,
            ];

            if (isset($args['blocks'])) {
                $blocks = $args['blocks'];
                $data['blocks'] = is_string($blocks) ? json_decode($blocks, true) : $blocks;
            }
            if (isset($args['thread_ts'])) {
                $data['thread_ts'] = $args['thread_ts'];
            }
            if (isset($args['reply_broadcast'])) {
                $data['reply_broadcast'] = (bool) $args['reply_broadcast'];
            }
            if (isset($args['unfurl_links'])) {
                $data['unfurl_links'] = (bool) $args['unfurl_links'];
            }
            if (isset($args['markdown'])) {
                $data['mrkdwn'] = (bool) $args['markdown'];
            }

            $result = $this->service->sendMessage($data);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result['channel'] ?? $channel,
                'ts' => $result['ts'] ?? '',
                'message' => $result['message'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
