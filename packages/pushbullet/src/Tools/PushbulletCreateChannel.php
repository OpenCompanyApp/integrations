<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Create a Pushbullet channel.
 *
 * Channels can send pushes to users who subscribe to the channel tag.
 */
class PushbulletCreateChannel implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_create_channel'; }

    public function description(): string { return 'Create a Pushbullet channel with a globally unique tag.'; }

    public function parameters(): array
    {
        return [
            'tag' => ['type' => 'string', 'required' => true, 'description' => 'Globally unique channel tag.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Channel display name.'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Channel description.'],
            'image_url' => ['type' => 'string', 'description' => 'Image URL for the channel.'],
            'website_url' => ['type' => 'string', 'description' => 'Website URL for the channel.'],
            'feed_url' => ['type' => 'string', 'description' => 'RSS feed URL to post automatically.'],
            'feed_filters' => ['type' => 'array', 'description' => 'Optional RSS feed filters.', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Create a Pushbullet channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->createChannel($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
