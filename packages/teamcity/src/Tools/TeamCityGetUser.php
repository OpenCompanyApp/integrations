<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get one TeamCity user.
 */
class TeamCityGetUser extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_user';
    protected const DESCRIPTION = 'Get a TeamCity user by locator.';
    protected const METHOD = 'getUser';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'User locator, for example username:ada.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
