<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Slack channel.
 */
class SlackCreateChannel implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_create_channel';
    }

    public function description(): string
    {
        return 'Create a new Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Channel name (lowercase, no spaces, max 80 chars).'],
            'is_private' => ['type' => 'boolean', 'description' => 'Create a private channel instead of a public one (default: false).'],
        ];
    }

    /**
     * Create a new public or private channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, is_private)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $name = $args['name'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['is_private'])) {
                $data['is_private'] = (bool) $args['is_private'];
            }

            $result = $this->service->createChannel($data);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result['channel'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
