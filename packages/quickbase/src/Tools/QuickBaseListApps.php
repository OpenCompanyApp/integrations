<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * List Quickbase apps available to the authenticated user.
 */
class QuickBaseListApps extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_list_apps';
    public const DESCRIPTION = 'List Quickbase apps available to the authenticated user.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as name, limit, and offset.'],
    ];

    /**
     * List apps.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listApps($this->arrayArg($args, 'params'));
    }
}
