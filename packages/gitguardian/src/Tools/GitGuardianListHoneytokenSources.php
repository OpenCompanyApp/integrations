<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List sources on an honeytoken.
 *
 * Maps to the official GitGuardian endpoint GET /v1/honeytokens/{honeytoken_id}/sources.
 */
class GitGuardianListHoneytokenSources extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_honeytoken_sources';
    protected const DESCRIPTION = 'List sources where a honeytoken appears.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}/sources.';
    protected const PARAMETERS = [
        'honeytoken_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the honeytoken to retrieve',
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
            'enum' => ['source_id', '-source_id'],
        ],
        'provider_metadata_archived' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'provider_metadata_archived',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}/sources';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ordering' => 'ordering',
        'provider_metadata_archived' => 'provider_metadata_archived',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
