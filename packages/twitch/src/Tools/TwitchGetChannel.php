<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a specific Twitch channel by broadcaster ID.
 *
 * Wraps the Twitch Helix GET /channels?broadcaster_id={id} endpoint.
 */
class TwitchGetChannel implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_get_channel';
    }

    public function description(): string
    {
        return 'Get information about a specific Twitch channel by broadcaster ID. Returns channel title, game, description, and broadcast settings.';
    }

    public function parameters(): array
    {
        return [
            'broadcaster_id' => ['type' => 'string', 'required' => true, 'description' => 'The broadcaster\'s user ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $result = $this->service->getChannel($args['broadcaster_id']);

            $channels = $result['data'] ?? [];

            if (empty($channels)) {
                return ToolResult::success([
                    'channel' => null,
                    'message' => 'No channel found for the given broadcaster ID.',
                ]);
            }

            $channel = $channels[0];

            return ToolResult::success([
                'channel' => [
                    'broadcaster_id' => $channel['broadcaster_id'] ?? null,
                    'broadcaster_login' => $channel['broadcaster_login'] ?? null,
                    'broadcaster_name' => $channel['broadcaster_name'] ?? null,
                    'game_id' => $channel['game_id'] ?? null,
                    'game_name' => $channel['game_name'] ?? null,
                    'title' => $channel['title'] ?? null,
                    'broadcaster_language' => $channel['broadcaster_language'] ?? null,
                    'description' => $channel['description'] ?? null,
                    'delay' => $channel['delay'] ?? 0,
                    'tags' => $channel['tags'] ?? [],
                    'content_classification_labels' => $channel['content_classification_labels'] ?? [],
                    'is_live' => $channel['is_live'] ?? false,
                    'started_at' => $channel['started_at'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
