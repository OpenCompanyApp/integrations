<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List notes on a public secret incident.
 *
 * Maps to the official GitGuardian endpoint GET /v1/public-incidents/secrets/{incident_id}/notes.
 */
class GitGuardianListPublicIncidentNotes extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_public_incident_notes';
    protected const DESCRIPTION = 'List notes left on a public secret incident in chronological order.

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/notes.';
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
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['created_at', '-created_at', 'updated_at', '-updated_at'],
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by member id.',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}/notes';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ordering' => 'ordering',
        'member_id' => 'member_id',
        'search' => 'search',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
