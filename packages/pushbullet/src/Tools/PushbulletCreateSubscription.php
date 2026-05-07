<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Subscribe to a Pushbullet channel.
 *
 * Channels are identified by their public tag.
 */
class PushbulletCreateSubscription implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_create_subscription'; }

    public function description(): string { return 'Subscribe the authenticated Pushbullet user to a channel by tag.'; }

    public function parameters(): array
    {
        return [
            'channel_tag' => ['type' => 'string', 'required' => true, 'description' => 'Channel tag to subscribe to.'],
        ];
    }

    /**
     * Create a Pushbullet subscription.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->createSubscription($args['channel_tag'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
