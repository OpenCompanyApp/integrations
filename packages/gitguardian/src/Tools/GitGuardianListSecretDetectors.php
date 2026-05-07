<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List secret detectors.
 *
 * Maps to the official GitGuardian endpoint GET /v1/secret_detectors.
 */
class GitGuardianListSecretDetectors extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_secret_detectors';
    protected const DESCRIPTION = 'List secret detectors.

Official GitGuardian endpoint: GET /v1/secret_detectors.';
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
        'is_active' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'is_active',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'type',
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
            'enum' => ['name', '-name'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/secret_detectors';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'is_active' => 'is_active',
        'type' => 'type',
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
