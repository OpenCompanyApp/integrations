<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List live streams on Twitch, optionally filtered by game, language, or user.
 *
 * Wraps the Twitch Helix GET /streams endpoint.
 */
class TwitchListStreams implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_list_streams';
    }

    public function description(): string
    {
        return 'List live streams on Twitch. Filter by game, language, or specific users. Returns stream title, viewer count, and broadcaster info.';
    }

    public function parameters(): array
    {
        return [
            'game_id' => ['type' => 'string', 'description' => 'Filter by game/category ID. Use search_categories to find the ID.'],
            'language' => ['type' => 'string', 'description' => 'Filter by stream language (e.g., "en", "es", "fr", "de", "pt", "ko", "ja").'],
            'user_id' => ['type' => 'string', 'description' => 'Filter by broadcaster user ID.'],
            'user_login' => ['type' => 'string', 'description' => 'Filter by broadcaster login name.'],
            'first' => ['type' => 'integer', 'description' => 'Number of results to return (max 100, default 20).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'before' => ['type' => 'string', 'description' => 'Cursor for backward pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $params = [];
            if (isset($args['game_id'])) {
                $params['game_id'] = $args['game_id'];
            }
            if (isset($args['language'])) {
                $params['language'] = $args['language'];
            }
            if (isset($args['user_id'])) {
                $params['user_id'] = $args['user_id'];
            }
            if (isset($args['user_login'])) {
                $params['user_login'] = $args['user_login'];
            }
            if (isset($args['first'])) {
                $params['first'] = min((int) $args['first'], 100);
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }

            $result = $this->service->listStreams($params);

            $streams = $result['data'] ?? [];
            $formatted = array_map(function (array $stream): array {
                return [
                    'id' => $stream['id'] ?? null,
                    'user_id' => $stream['user_id'] ?? null,
                    'user_login' => $stream['user_login'] ?? null,
                    'user_name' => $stream['user_name'] ?? null,
                    'game_id' => $stream['game_id'] ?? null,
                    'game_name' => $stream['game_name'] ?? null,
                    'title' => $stream['title'] ?? null,
                    'viewer_count' => $stream['viewer_count'] ?? 0,
                    'language' => $stream['language'] ?? null,
                    'started_at' => $stream['started_at'] ?? null,
                    'thumbnail_url' => $stream['thumbnail_url'] ?? null,
                    'is_mature' => $stream['is_mature'] ?? false,
                    'tags' => $stream['tags'] ?? [],
                ];
            }, $streams);

            return ToolResult::success([
                'streams' => $formatted,
                'count' => count($formatted),
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
