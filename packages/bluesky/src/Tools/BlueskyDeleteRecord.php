<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Delete an AT Protocol record from the authenticated repository.
 */
class BlueskyDeleteRecord extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_delete_record';
    protected const DESCRIPTION = 'Delete an AT Protocol record from the authenticated repository by collection and rkey.';
    protected const PARAMETERS = [
        'collection' => ['type' => 'string', 'required' => true, 'description' => 'AT Protocol collection name.'],
        'rkey' => ['type' => 'string', 'required' => true, 'description' => 'Record key.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->deleteRecord($this->stringArg($args, 'collection'), $this->stringArg($args, 'rkey'));
    }
}
