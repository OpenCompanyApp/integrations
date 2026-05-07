<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Bulk requests.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/bulk_requests.
 */
class GreenhouseGetV3BulkRequests extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_bulk_requests';
    protected const DESCRIPTION = 'Bulk requests

Official Greenhouse Harvest v3 endpoint: GET /v3/bulk_requests.';
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
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'bulk_action_uuid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `bulk_action_uuid`.',
        ],
        'active' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `active`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/bulk_requests';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'bulk_action_uuid' => 'bulk_action_uuid',
        'active' => 'active',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
