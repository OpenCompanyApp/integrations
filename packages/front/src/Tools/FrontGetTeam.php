<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a Front team or workspace by ID.
 */
class FrontGetTeam extends AbstractFrontTool
{
    protected const NAME = 'front_get_team';
    protected const DESCRIPTION = 'Get a Front team, also called a workspace, by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}';
    protected const REQUIRED = ['team_id'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
    ];
}
