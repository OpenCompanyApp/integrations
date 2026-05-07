<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List builds for one TeamCity build configuration.
 */
class TeamCityListBuildTypeBuilds extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_build_type_builds';
    protected const DESCRIPTION = 'List builds for a TeamCity build configuration with optional build locator and fields.';
    protected const METHOD = 'listBuildTypeBuilds';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build type locator.'],
        'locator_filter' => ['type' => 'string', 'description' => 'Use query.locator for TeamCity build locator filtering.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
