<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List developers.
 *
 * Maps to the official GitGuardian endpoint GET /v1/public-perimeter/developers.
 */
class GitGuardianListDevelopers extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_developers';
    protected const DESCRIPTION = 'List developers in the public perimeter.

Official GitGuardian endpoint: GET /v1/public-perimeter/developers.';
    protected const PARAMETERS = [
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['github_login', '-github_login', 'name', '-name', 'emails', '-emails', 'is_active', '-is_active'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/public-perimeter/developers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
