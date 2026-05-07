<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List secret occurrences.
 *
 * Maps to the official GitGuardian endpoint GET /v1/occurrences/secrets.
 */
class GitGuardianListOccs extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_occs';
    protected const DESCRIPTION = 'List occurrences of secrets in the monitored perimeter.

Official GitGuardian endpoint: GET /v1/occurrences/secrets.';
    protected const PARAMETERS = [
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
        'date_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'date_before',
        ],
        'date_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'date_after',
        ],
        'source_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter on the source ID.',
        ],
        'source_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'source_name',
        ],
        'source_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'source_type',
        ],
        'incident_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by incident ID.',
        ],
        'incident_assignee_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by incident assignee member ID.',
        ],
        'presence' => [
            'type' => 'string',
            'required' => false,
            'description' => 'presence',
        ],
        'author_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'author_name',
        ],
        'author_info' => [
            'type' => 'string',
            'required' => false,
            'description' => 'author_info',
        ],
        'sha' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sha',
        ],
        'filepath' => [
            'type' => 'string',
            'required' => false,
            'description' => 'filepath',
        ],
        'severity' => [
            'type' => 'string',
            'required' => false,
            'description' => 'severity',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
        ],
        'validity' => [
            'type' => 'string',
            'required' => false,
            'description' => 'validity',
        ],
        'tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'tags',
        ],
        'exclude_tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'exclude_tags',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['date', '-date'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/occurrences/secrets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'date_before' => 'date_before',
        'date_after' => 'date_after',
        'source_id' => 'source_id',
        'source_name' => 'source_name',
        'source_type' => 'source_type',
        'incident_id' => 'incident_id',
        'incident_assignee_id' => 'incident_assignee_id',
        'presence' => 'presence',
        'author_name' => 'author_name',
        'author_info' => 'author_info',
        'sha' => 'sha',
        'filepath' => 'filepath',
        'severity' => 'severity',
        'status' => 'status',
        'validity' => 'validity',
        'tags' => 'tags',
        'exclude_tags' => 'exclude_tags',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
