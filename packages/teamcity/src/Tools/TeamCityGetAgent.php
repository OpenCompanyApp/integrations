<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get one TeamCity agent.
 */
class TeamCityGetAgent extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_agent';
    protected const DESCRIPTION = 'Get a TeamCity build agent by locator.';
    protected const METHOD = 'getAgent';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Agent locator, for example id:12.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
    ];
}
