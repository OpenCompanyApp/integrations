<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Cancel a running TeamCity build.
 */
class TeamCityCancelBuild extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_cancel_build';
    protected const DESCRIPTION = 'Cancel a started TeamCity build by locator with an optional BuildCancelRequest payload.';
    protected const METHOD = 'cancelBuild';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'payload' => ['type' => 'object', 'description' => 'Optional BuildCancelRequest payload with comment and readdIntoQueue.'],
    ];
}
