<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List audit Logs.
 *
 * Maps to the official GitGuardian endpoint GET /v1/audit_logs.
 */
class GitGuardianListAuditLogs extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_audit_logs';
    protected const DESCRIPTION = 'List audit logs.

Official GitGuardian endpoint: GET /v1/audit_logs.';
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
        'event_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this event name.',
        ],
        'member_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The id of the member to retrieve.',
        ],
        'member_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this member name.',
        ],
        'member_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this member email.',
        ],
        'api_token_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this API token id.',
        ],
        'ip_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Entries matching this IP address.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/audit_logs';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'date_before' => 'date_before',
        'date_after' => 'date_after',
        'event_name' => 'event_name',
        'member_id' => 'member_id',
        'member_name' => 'member_name',
        'member_email' => 'member_email',
        'api_token_id' => 'api_token_id',
        'ip_address' => 'ip_address',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
