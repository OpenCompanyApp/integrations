<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List inboxes belonging to a Front team workspace.
 */
class FrontListTeamInboxes extends AbstractFrontTool
{
    protected const NAME = 'front_list_team_inboxes';
    protected const DESCRIPTION = 'List inboxes belonging to a Front team workspace.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/inboxes';
    protected const REQUIRED = ['team_id'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
    ];
}
