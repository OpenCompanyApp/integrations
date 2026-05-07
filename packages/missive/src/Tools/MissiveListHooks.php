<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive webhook subscriptions.
 */
class MissiveListHooks extends AbstractMissiveTool
{
    public const NAME = 'missive_list_hooks';
    public const DESCRIPTION = 'List Missive webhook subscriptions.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
    ];

    /**
     * List hooks.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listHooks($this->arrayArg($args, 'params'));
    }
}
