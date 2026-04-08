<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List channel information on Twitch.
 *
 * Wraps the Twitch Helix GET /channels endpoint.
 */
class TwitchListChannels implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_list_channels';
    }

    public function description(): string
    {
        return 'List channel information on Twitch. Filter by broadcaster ID. Returns channel description, game, and broadcast settings.';
    }

    public function parameters(): array
    {
        return [
            'broadcaster_id' => ['type' => 'string', 'description' => 'Filter by broadcaster user ID.'],
            'first' => ['type' => 'integer', 'description' => 'Number of results to return (max 100, default 20).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $params = [];
            if (isset($args['broadcaster_id'])) {
                $params['broadcaster_id'] = $args['broadcaster_id'];
            }
            if (isset($args['first'])) {
                $params['first'] = min((int) $args['first'], 100);
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->listChannels($params);

            $channels = $result['data'] ?? [];
            $formatted = array_map(function (array $channel): array {
                return [
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
                ];
            }, $channels);

            return ToolResult::success([
                'channels' => $formatted,
                'count' => count($formatted),
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
