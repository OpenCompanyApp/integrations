<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List custom sources.
 *
 * Maps to the official GitGuardian endpoint GET /v1/sources/custom-sources.
 */
class GitGuardianListCustomSources extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_custom_sources';
    protected const DESCRIPTION = 'List custom sources for the authenticated account. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: GET /v1/sources/custom-sources.';
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
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['id', '-id', 'name', '-name'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/sources/custom-sources';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
