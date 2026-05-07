<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive teams.
 */
class MissiveListTeams extends AbstractMissiveTool
{
    public const NAME = 'missive_list_teams';
    public const DESCRIPTION = 'List teams in organizations the authenticated Missive user is part of.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
    ];

    /**
     * List teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listTeams($this->arrayArg($args, 'params'));
    }
}
