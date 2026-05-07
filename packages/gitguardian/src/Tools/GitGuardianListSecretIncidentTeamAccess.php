<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List teams with access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/secret-incidents/{incident_id}/teams.
 */
class GitGuardianListSecretIncidentTeamAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_secret_incident_team_access';
    protected const DESCRIPTION = 'List teams that have access to a secret incident.

Official GitGuardian endpoint: GET /v1/secret-incidents/{incident_id}/teams.';
    protected const PARAMETERS = [
        'incident_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the incident to retrieve',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'direct_access' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Filter on direct or indirect accesses.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/secret-incidents/{incident_id}/teams';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'search' => 'search',
        'direct_access' => 'direct_access',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
