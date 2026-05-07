<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Execute a raw Discord API DELETE request.
 *
 * Allows agents to call delete endpoints while destructive common actions remain explicit.
 */
class DiscordApiDelete extends AbstractDiscordTool
{
    protected const NAME = 'discord_api_delete';
    protected const DESCRIPTION = 'Execute a raw DELETE request against Discord REST API v10. Pass optional JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Discord API path relative to /api/v10.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
