<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List members with access to a secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/secret-incidents/{incident_id}/members.
 */
class GitGuardianListSecretIncidentMemberAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_secret_incident_member_access';
    protected const DESCRIPTION = 'List members that have access to a secret incident.

Official GitGuardian endpoint: GET /v1/secret-incidents/{incident_id}/members.';
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
        'role' => [
            'type' => 'string',
            'required' => false,
            'description' => 'role',
        ],
        'access_level' => [
            'type' => 'string',
            'required' => false,
            'description' => 'access_level',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['created_at', '-created_at', 'last_login', '-last_login'],
        ],
        'direct_access' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Filter on direct or indirect accesses.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/secret-incidents/{incident_id}/members';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'role' => 'role',
        'access_level' => 'access_level',
        'search' => 'search',
        'ordering' => 'ordering',
        'direct_access' => 'direct_access',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
