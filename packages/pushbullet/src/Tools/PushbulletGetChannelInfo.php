<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Get information about a Pushbullet channel.
 *
 * Channel info is addressed by public channel tag.
 */
class PushbulletGetChannelInfo implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_get_channel_info'; }

    public function description(): string { return 'Get public information for a Pushbullet channel by tag.'; }

    public function parameters(): array
    {
        return [
            'tag' => ['type' => 'string', 'required' => true, 'description' => 'Channel tag.'],
            'no_recent_pushes' => ['type' => 'boolean', 'description' => 'Set true to omit recent pushes from the response.'],
        ];
    }

    /**
     * Get Pushbullet channel information.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->getChannelInfo($args['tag'] ?? '', $args['no_recent_pushes'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
