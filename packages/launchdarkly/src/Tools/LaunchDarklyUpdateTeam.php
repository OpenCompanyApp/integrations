<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly team.
 */
class LaunchDarklyUpdateTeam extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_team';
    protected const DESCRIPTION = 'Update a LaunchDarkly team. Use a LaunchDarkly-supported semantic patch or JSON Patch body.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/teams/{team_key}';
    protected const REQUIRED = ['team_key'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'team_key' => ['type' => 'string', 'required' => true, 'description' => 'Team key.'],
        'patch' => ['type' => 'array', 'description' => 'JSON Patch operations.'],
        'body' => ['type' => 'object', 'description' => 'Semantic patch or merge patch payload accepted by LaunchDarkly.'],
    ];
}
