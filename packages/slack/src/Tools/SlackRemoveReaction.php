<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove an emoji reaction from a Slack message.
 */
class SlackRemoveReaction implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_remove_reaction';
    }

    public function description(): string
    {
        return 'Remove an emoji reaction from a Slack message.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID where the message is posted.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Emoji name without colons (e.g., "thumbsup", "heart").'],
            'timestamp' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the message.'],
        ];
    }

    /**
     * Remove a reaction from a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, name, timestamp)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $name = $args['name'] ?? '';
            $timestamp = $args['timestamp'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name (emoji name) is required.');
            }
            if (empty($timestamp)) {
                return ToolResult::error('timestamp is required.');
            }

            $this->service->removeReaction([
                'channel' => $channel,
                'name' => $name,
                'timestamp' => $timestamp,
            ]);

            return ToolResult::success([
                'ok' => true,
                'channel' => $channel,
                'name' => $name,
                'timestamp' => $timestamp,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
