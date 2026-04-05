<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Set the topic for a Slack channel.
 */
class SlackSetTopic implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_set_topic';
    }

    public function description(): string
    {
        return 'Set the topic for a Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'topic' => ['type' => 'string', 'required' => true, 'description' => 'The new topic text.'],
        ];
    }

    /**
     * Set the topic text on a channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, topic)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $topic = $args['topic'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($topic)) {
                return ToolResult::error('topic is required.');
            }

            $result = $this->service->setTopic([
                'channel' => $channel,
                'topic' => $topic,
            ]);

            return ToolResult::success([
                'ok' => true,
                'topic' => $result['topic'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
