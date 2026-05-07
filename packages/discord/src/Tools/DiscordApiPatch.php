<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Execute a raw Discord API PATCH request.
 *
 * Supports long-tail update endpoints while common operations have first-class tools.
 */
class DiscordApiPatch extends AbstractDiscordTool
{
    protected const NAME = 'discord_api_patch';
    protected const DESCRIPTION = 'Execute a raw PATCH request against Discord REST API v10. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Discord API path relative to /api/v10.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
