<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List public secret occurrences.
 *
 * Maps to the official GitGuardian endpoint GET /v1/public-incidents/secrets/{incident_id}/occurrences.
 */
class GitGuardianListPublicSecretOccurrences extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_public_secret_occurrences';
    protected const DESCRIPTION = 'List occurrences of a public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/occurrences.';
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
        'presence' => [
            'type' => 'string',
            'required' => false,
            'description' => 'presence',
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
        'attachment_reason' => [
            'type' => 'string',
            'required' => false,
            'description' => 'attachment_reason',
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
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['id', '-id', 'date', '-date'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/public-incidents/secrets/{incident_id}/occurrences';
    protected const PATH_PARAMS = [
        'incident_id' => 'incident_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'date_before' => 'date_before',
        'date_after' => 'date_after',
        'source_id' => 'source_id',
        'presence' => 'presence',
        'sha' => 'sha',
        'filepath' => 'filepath',
        'attachment_reason' => 'attachment_reason',
        'severity' => 'severity',
        'status' => 'status',
        'validity' => 'validity',
        'tags' => 'tags',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
