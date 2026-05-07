<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List teams having access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/teams.
 */
class GitGuardianListIncidentTeams extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_incident_teams';
    protected const DESCRIPTION = 'List all the teams having access to a secret incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/teams](#tag/Secret-Incidents/operation/list-secret-incident-team-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/teams.';
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
        'team_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'team_id',
        ],
        'incident_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'incident_permission',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/teams';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'team_id' => 'team_id',
        'incident_permission' => 'incident_permission',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
