<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive users.
 */
class MissiveListUsers extends AbstractMissiveTool
{
    public const NAME = 'missive_list_users';
    public const DESCRIPTION = 'List users in organizations the authenticated Missive user is part of.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
    ];

    /**
     * List users.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listUsers($this->arrayArg($args, 'params'));
    }
}
