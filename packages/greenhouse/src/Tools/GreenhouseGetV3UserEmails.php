<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List user emails.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/user_emails.
 */
class GreenhouseGetV3UserEmails extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_user_emails';
    protected const DESCRIPTION = 'List user emails

Official Greenhouse Harvest v3 endpoint: GET /v3/user_emails.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
        ],
        'per_page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Number of results per page',
        ],
        'ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'created_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `created_at`.',
        ],
        'updated_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `updated_at`.',
        ],
        'user_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'email' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'verified' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `verified`.',
        ],
        'verification_token_sent_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `verification_token_sent_at`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/user_emails';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'user_ids' => 'user_ids',
        'fields' => 'fields',
        'email' => 'email',
        'verified' => 'verified',
        'verification_token_sent_at' => 'verification_token_sent_at',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'user_ids' => 'form',
        'fields' => 'form',
        'email' => 'form',
        'verification_token_sent_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
