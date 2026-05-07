<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a team perimeter.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams/{team_id}/sources.
 */
class GitGuardianUpdateTeamSources extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_team_sources';
    protected const DESCRIPTION = 'This endpoint allows you to add and remove sources from the perimeter of a team. If you are using a personal access token, you need to be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/sources.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams/{team_id}/sources';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
