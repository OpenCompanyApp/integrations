<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Call a safe relative TeamCity POST path.
 */
class TeamCityApiPost extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_api_post';
    protected const DESCRIPTION = 'Call a safe relative TeamCity REST API POST path. Prefer named tools when available.';
    protected const METHOD = 'apiPost';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /app/rest.'],
        'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
}
