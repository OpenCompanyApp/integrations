<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Call a safe relative TeamCity PATCH path.
 */
class TeamCityApiPatch extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_api_patch';
    protected const DESCRIPTION = 'Call a safe relative TeamCity REST API PATCH path. Prefer named tools when available.';
    protected const METHOD = 'apiPatch';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /app/rest.'],
        'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
}
