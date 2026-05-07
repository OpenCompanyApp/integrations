<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Call any POST XRPC method.
 */
class BlueskyXrpcPost extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_xrpc_post';
    protected const DESCRIPTION = 'Call any POST XRPC method by method ID with a JSON body.';
    protected const PARAMETERS = [
        'method' => ['type' => 'string', 'required' => true, 'description' => 'XRPC method ID such as com.atproto.repo.createRecord.'],
        'body' => ['type' => 'object', 'description' => 'JSON body.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->xrpcPost($this->stringArg($args, 'method'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
