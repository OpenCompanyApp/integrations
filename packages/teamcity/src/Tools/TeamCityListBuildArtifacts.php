<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * List TeamCity build artifacts.
 */
class TeamCityListBuildArtifacts extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_list_build_artifacts';
    protected const DESCRIPTION = 'List artifact files under a build artifact path.';
    protected const METHOD = 'listBuildArtifacts';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Build locator, for example id:12345.'],
        'path' => ['type' => 'string', 'description' => 'Artifact subpath. Defaults to root.'],
        'basePath' => ['type' => 'string', 'description' => 'Optional TeamCity basePath query parameter.'],
        'fields' => ['type' => 'string', 'description' => 'TeamCity fields selector.'],
        'query' => ['type' => 'object', 'description' => 'Additional TeamCity query parameters.'],
    ];
}
