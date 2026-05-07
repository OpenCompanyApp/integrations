<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Create a Droplr drop from a caller-supplied payload.
 */
class DroplrCreateDropRaw extends AbstractDroplrTool
{
    public const NAME = 'droplr_create_drop_raw';
    public const DESCRIPTION = 'Create a Droplr drop from a raw API-supported payload.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Droplr drop creation payload.'],
    ];

    /**
     * Create a drop from a raw payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createDrop($this->requiredArray($args, 'body', 'body'));
    }
}
