<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team sources.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/sources.
 */
class GitGuardianListTeamSources extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_team_sources';
    protected const DESCRIPTION = 'List sources belonging to a team\'s perimeter.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/sources.';
    protected const PARAMETERS = [
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
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'last_scan_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'last_scan_status',
        ],
        'health' => [
            'type' => 'string',
            'required' => false,
            'description' => 'health',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'type',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['last_scan_date', '-last_scan_date'],
        ],
        'visibility' => [
            'type' => 'string',
            'required' => false,
            'description' => 'visibility',
            'enum' => ['public', 'private', 'internal'],
        ],
        'external_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'external_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/sources';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'search' => 'search',
        'last_scan_status' => 'last_scan_status',
        'health' => 'health',
        'type' => 'type',
        'ordering' => 'ordering',
        'visibility' => 'visibility',
        'external_id' => 'external_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
