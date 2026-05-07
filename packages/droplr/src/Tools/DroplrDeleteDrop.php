<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Delete a Droplr drop.
 */
class DroplrDeleteDrop extends AbstractDroplrTool
{
    public const NAME = 'droplr_delete_drop';
    public const DESCRIPTION = 'Delete a Droplr drop by ID or short code.';
    public const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Drop ID or short code.'],
    ];

    /**
     * Delete one drop.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function call(array $args): string
    {
        $id = $this->requiredString($args, 'id', 'drop ID');
        $this->service->deleteDrop($id);

        return "Drop '{$id}' has been deleted.";
    }
}
