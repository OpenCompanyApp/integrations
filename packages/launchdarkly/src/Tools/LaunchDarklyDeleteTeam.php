<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Delete a LaunchDarkly team.
 */
class LaunchDarklyDeleteTeam extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_delete_team';
    protected const DESCRIPTION = 'Delete a LaunchDarkly team by team key.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/teams/{team_key}';
    protected const REQUIRED = ['team_key'];
    protected const PARAMETERS = [
        'team_key' => ['type' => 'string', 'required' => true, 'description' => 'Team key.'],
    ];
}
