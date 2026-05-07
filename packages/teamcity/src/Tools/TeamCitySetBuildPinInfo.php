<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Set TeamCity build pin information.
 */
class TeamCitySetBuildPinInfo extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_set_build_pin_info';
    protected const DESCRIPTION = 'Pin or unpin a TeamCity build by sending the official PinInfo entity payload.';
    protected const METHOD = 'setBuildPinInfo';
    protected const REQUIRED = ['locator', 'payload'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'TeamCity PinInfo entity payload.'],
    ];
}
