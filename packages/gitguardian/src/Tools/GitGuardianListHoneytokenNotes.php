<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List notes on an honeytoken.
 *
 * Maps to the official GitGuardian endpoint GET /v1/honeytokens/{honeytoken_id}/notes.
 */
class GitGuardianListHoneytokenNotes extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_honeytoken_notes';
    protected const DESCRIPTION = 'List notes left on a honeytoken in chronological order.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}/notes.';
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
            'enum' => ['created_at', '-created_at', 'updated_at', '-updated_at'],
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter by member id.',
        ],
        'api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this API token id.',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/honeytokens/{honeytoken_id}/notes';
    protected const PATH_PARAMS = [
        'honeytoken_id' => 'honeytoken_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ordering' => 'ordering',
        'member_id' => 'member_id',
        'api_token_id' => 'api_token_id',
        'search' => 'search',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
