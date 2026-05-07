<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List custom tags.
 *
 * Maps to the official GitGuardian endpoint GET /v1/custom_tags.
 */
class GitGuardianListCustomTags extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_custom_tags';
    protected const DESCRIPTION = 'List all existing custom tags.

Official GitGuardian endpoint: GET /v1/custom_tags.';
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
        'key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'key',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/custom_tags';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'key' => 'key',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
