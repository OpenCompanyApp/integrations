<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Call a safe relative TeamCity GET path.
 */
class TeamCityApiGet extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_api_get';
    protected const DESCRIPTION = 'Call a safe relative TeamCity REST API GET path. Prefer named tools when available.';
    protected const METHOD = 'apiGet';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /app/rest, for example /projects.'],
        'query' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];
}
