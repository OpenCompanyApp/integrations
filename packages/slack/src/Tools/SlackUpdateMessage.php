<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Slack message.
 *
 * Supports updating text and Block Kit blocks.
 */
class SlackUpdateMessage implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_update_message';
    }

    public function description(): string
    {
        return 'Update an existing Slack message.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID where the message was posted.'],
            'ts' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the message to update.'],
            'text' => ['type' => 'string', 'description' => 'New message text.'],
            'blocks' => ['type' => 'string', 'description' => 'JSON array of Slack Block Kit blocks.'],
        ];
    }

    /**
     * Update a message's text or blocks by channel and timestamp.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, ts, text, blocks)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $ts = $args['ts'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($ts)) {
                return ToolResult::error('ts (message timestamp) is required.');
            }
            if (empty($args['text']) && empty($args['blocks'])) {
                return ToolResult::error('text or blocks is required.');
            }

            $data = [
                'channel' => $channel,
                'ts' => $ts,
            ];

            if (isset($args['text'])) {
                $data['text'] = $args['text'];
            }
            if (isset($args['blocks'])) {
                $blocks = $args['blocks'];
                $data['blocks'] = is_string($blocks) ? json_decode($blocks, true) : $blocks;
            }

            $result = $this->service->updateMessage($data);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result['channel'] ?? $channel,
                'ts' => $result['ts'] ?? $ts,
                'text' => $result['text'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
