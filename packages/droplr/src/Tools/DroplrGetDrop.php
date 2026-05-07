<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Get one Droplr drop.
 */
class DroplrGetDrop extends AbstractDroplrTool
{
    public const NAME = 'droplr_get_drop';
    public const DESCRIPTION = 'Get details for a specific Droplr drop by ID or short code.';
    public const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Drop ID or short code.'],
    ];

    /**
     * Get one drop.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getDrop($this->requiredString($args, 'id', 'drop ID'));
    }
}
