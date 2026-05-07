<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Update a Droplr drop.
 */
class DroplrUpdateDrop extends AbstractDroplrTool
{
    public const NAME = 'droplr_update_drop';
    public const DESCRIPTION = 'Update a Droplr drop by ID or short code.';
    public const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Drop ID or short code.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Droplr drop update payload.'],
    ];

    /**
     * Update one drop.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateDrop(
            $this->requiredString($args, 'id', 'drop ID'),
            $this->requiredArray($args, 'body', 'body')
        );
    }
}
