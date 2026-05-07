<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Add tags to a TeamCity build.
 */
class TeamCityAddBuildTags extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_add_build_tags';
    protected const DESCRIPTION = 'Add tags to a TeamCity build. Provide the official Tags entity in payload.';
    protected const METHOD = 'addBuildTags';
    protected const REQUIRED = ['locator', 'payload'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'TeamCity Tags entity payload.'],
    ];
}
