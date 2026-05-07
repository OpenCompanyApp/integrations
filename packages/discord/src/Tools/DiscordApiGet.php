<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Execute a raw Discord API GET request.
 *
 * Provides long-tail coverage for Discord REST v10 endpoints.
 */
class DiscordApiGet extends AbstractDiscordTool
{
    protected const NAME = 'discord_api_get';
    protected const DESCRIPTION = 'Execute a raw GET request against Discord REST API v10. Use paths such as `/guilds/{guild_id}/roles` and pass query parameters in query.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Discord API path relative to /api/v10.'],
        'query' => ['type' => 'object', 'description' => 'Query string parameters.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
