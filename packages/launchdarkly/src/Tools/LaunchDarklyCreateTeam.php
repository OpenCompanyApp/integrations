<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Create a LaunchDarkly team.
 */
class LaunchDarklyCreateTeam extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_create_team';
    protected const DESCRIPTION = 'Create a LaunchDarkly team. This capability may require an Enterprise plan and sufficient account permissions.';
    protected const METHOD = 'POST';
    protected const PATH = '/teams';
    protected const REQUIRED = ['key', 'name'];
    protected const BODY_KEYS = ['key', 'name', 'description', 'maintainerId', 'memberIDs', 'roleAttributes'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique team key.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable team name.'],
        'description' => ['type' => 'string', 'description' => 'Team description.'],
        'maintainerId' => ['type' => 'string', 'description' => 'Member ID for the team maintainer.'],
        'memberIDs' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Initial member IDs.'],
        'roleAttributes' => ['type' => 'object', 'description' => 'Role attributes assigned to the team.'],
        'body' => ['type' => 'object', 'description' => 'Additional team fields accepted by LaunchDarkly.'],
    ];
}
