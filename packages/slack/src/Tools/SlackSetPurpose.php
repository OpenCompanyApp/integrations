<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Set the purpose for a Slack channel.
 */
class SlackSetPurpose implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_set_purpose';
    }

    public function description(): string
    {
        return 'Set the purpose for a Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'purpose' => ['type' => 'string', 'required' => true, 'description' => 'The new purpose text.'],
        ];
    }

    /**
     * Set the purpose text on a channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, purpose)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $purpose = $args['purpose'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($purpose)) {
                return ToolResult::error('purpose is required.');
            }

            $result = $this->service->setPurpose([
                'channel' => $channel,
                'purpose' => $purpose,
            ]);

            return ToolResult::success([
                'ok' => true,
                'purpose' => $result['purpose'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
