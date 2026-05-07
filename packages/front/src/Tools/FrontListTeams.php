<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List Front teams or workspaces.
 */
class FrontListTeams extends AbstractFrontTool
{
    protected const NAME = 'front_list_teams';
    protected const DESCRIPTION = 'List teams, also called workspaces, in the Front company.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams';
    protected const PARAMETERS = [];
}
