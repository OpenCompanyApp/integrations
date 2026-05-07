<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Execute a raw Discord API PUT request.
 *
 * Covers idempotent Discord REST endpoints such as reaction and role assignment routes.
 */
class DiscordApiPut extends AbstractDiscordTool
{
    protected const NAME = 'discord_api_put';
    protected const DESCRIPTION = 'Execute a raw PUT request against Discord REST API v10. Pass optional JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Discord API path relative to /api/v10.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
