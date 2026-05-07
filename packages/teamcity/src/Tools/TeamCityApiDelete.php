<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Call a safe relative TeamCity DELETE path.
 */
class TeamCityApiDelete extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_api_delete';
    protected const DESCRIPTION = 'Call a safe relative TeamCity REST API DELETE path. Prefer named tools when available.';
    protected const METHOD = 'apiDelete';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /app/rest.'],
        'query' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];
}
