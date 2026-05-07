<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Call any GET XRPC method.
 */
class BlueskyXrpcGet extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_xrpc_get';
    protected const DESCRIPTION = 'Call any GET XRPC method by method ID with query parameters.';
    protected const PARAMETERS = [
        'method' => ['type' => 'string', 'required' => true, 'description' => 'XRPC method ID such as app.bsky.actor.getProfile.'],
        'params' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->xrpcGet($this->stringArg($args, 'method'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
