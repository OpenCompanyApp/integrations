<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Call a safe relative TeamCity PUT path.
 */
class TeamCityApiPut extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_api_put';
    protected const DESCRIPTION = 'Call a safe relative TeamCity REST API PUT path. Prefer named tools when available.';
    protected const METHOD = 'apiPut';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /app/rest.'],
        'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
}
