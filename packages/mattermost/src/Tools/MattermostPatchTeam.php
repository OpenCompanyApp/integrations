<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Patch a Mattermost team.
 *
 * Updates team profile fields.
 */
class MattermostPatchTeam extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_patch_team';
    protected const DESCRIPTION = 'Patch a Mattermost team. Provide changed fields or raw body.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'display_name' => ['type' => 'string', 'description' => 'Team display name.'],
        'description' => ['type' => 'string', 'description' => 'Team description.'],
        'company_name' => ['type' => 'string', 'description' => 'Company name.'],
        'body' => ['type' => 'object', 'description' => 'Raw Mattermost team patch body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/teams/{team_id}/patch';
    protected const REQUIRED = ['team_id'];
    protected const BODY_KEYS = ['display_name', 'description', 'company_name'];
    protected const BODY_REQUIRED = true;
}
