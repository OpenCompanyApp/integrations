<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Create an arbitrary AT Protocol record in the authenticated repository.
 */
class BlueskyCreateRecord extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_create_record';
    protected const DESCRIPTION = 'Create an arbitrary AT Protocol record in the authenticated repository.';
    protected const PARAMETERS = [
        'collection' => ['type' => 'string', 'required' => true, 'description' => 'AT Protocol collection name.'],
        'record' => ['type' => 'object', 'required' => true, 'description' => 'Record body.'],
        'rkey' => ['type' => 'string', 'description' => 'Optional record key.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        if (! is_array($args['record'] ?? null)) {
            throw new \RuntimeException('record must be an object.');
        }

        return $this->service->createRecord($this->stringArg($args, 'collection'), $args['record'], $args['rkey'] ?? null);
    }
}
