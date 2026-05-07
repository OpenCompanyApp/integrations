<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List members having access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/incidents/secrets/{incident_id}/members.
 */
class GitGuardianListIncidentMembers extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_incident_members';
    protected const DESCRIPTION = 'List all the members having access to a secret incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/members](#tag/Secret-Incidents/operation/list-secret-incident-member-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/members.';
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
        'page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Page number.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'member_id',
        ],
        'incident_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'incident_permission',
        ],
        'role' => [
            'type' => 'string',
            'required' => false,
            'description' => 'role',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/secrets/{incident_id}/members';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'member_id' => 'member_id',
        'incident_permission' => 'incident_permission',
        'role' => 'role',
        'search' => 'search',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
