<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List all honeytokens events.
 *
 * Maps to the official GitGuardian endpoint GET /v1/honeytokens_events.
 */
class GitGuardianListHoneytokensEvents extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_honeytokens_events';
    protected const DESCRIPTION = 'List events related to all honeytokens of the workspace.

Official GitGuardian endpoint: GET /v1/honeytokens_events.';
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
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'',
            'enum' => ['triggered_at', '-triggered_at'],
        ],
        'honeytoken_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by honeytoken id',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by status',
            'enum' => ['open', 'archived', 'allowed'],
        ],
        'ip_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by ip address',
        ],
        'tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'tags',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search events based on the `data` field content',
        ],
        'x_privacy_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
            'enum' => ['true', 'false'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/honeytokens_events';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ordering' => 'ordering',
        'honeytoken_id' => 'honeytoken_id',
        'status' => 'status',
        'ip_address' => 'ip_address',
        'tags' => 'tags',
        'search' => 'search',
    ];
    protected const HEADER_PARAMS = [
        'X-Privacy-Mode' => 'x_privacy_mode',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
