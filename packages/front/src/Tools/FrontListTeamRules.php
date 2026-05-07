<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List rules belonging to a Front team workspace.
 */
class FrontListTeamRules extends AbstractFrontTool
{
    protected const NAME = 'front_list_team_rules';
    protected const DESCRIPTION = 'List rules belonging to a Front team workspace.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/rules';
    protected const REQUIRED = ['team_id'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
    ];
}
