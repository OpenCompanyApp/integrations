<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get TeamCity build tags.
 */
class TeamCityGetBuildTags extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_build_tags';
    protected const DESCRIPTION = 'Get tags for a TeamCity build.';
    protected const METHOD = 'getBuildTags';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'locator_filter' => ['type' => 'string', 'description' => 'Use query.locator for TeamCity tag locator filtering.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
