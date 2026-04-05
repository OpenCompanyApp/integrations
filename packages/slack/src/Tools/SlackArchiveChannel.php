<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Archive a Slack channel.
 */
class SlackArchiveChannel implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_archive_channel';
    }

    public function description(): string
    {
        return 'Archive a Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID to archive.'],
        ];
    }

    /**
     * Archive a channel by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }

            $this->service->archiveChannel([
                'channel' => $channel,
            ]);

            return ToolResult::success([
                'ok' => true,
                'channel' => $channel,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
