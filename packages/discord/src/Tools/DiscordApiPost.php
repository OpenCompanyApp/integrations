<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Execute a raw Discord API POST request.
 *
 * Useful for newer Discord REST endpoints not yet exposed as first-class tools.
 */
class DiscordApiPost extends AbstractDiscordTool
{
    protected const NAME = 'discord_api_post';
    protected const DESCRIPTION = 'Execute a raw POST request against Discord REST API v10. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Discord API path relative to /api/v10.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
