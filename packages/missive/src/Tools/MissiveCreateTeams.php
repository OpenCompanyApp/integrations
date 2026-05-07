<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create one or more Missive teams.
 */
class MissiveCreateTeams extends AbstractMissiveTool
{
    public const NAME = 'missive_create_teams';
    public const DESCRIPTION = 'Create one or more Missive teams.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Team creation payload.'],
    ];

    /**
     * Create teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->createTeams($body);
    }
}
