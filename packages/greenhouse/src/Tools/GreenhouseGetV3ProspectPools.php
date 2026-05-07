<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List prospect pools.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/prospect_pools.
 */
class GreenhouseGetV3ProspectPools extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_prospect_pools';
    protected const DESCRIPTION = 'List prospect pools

Official Greenhouse Harvest v3 endpoint: GET /v3/prospect_pools.';
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
        'department_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'office_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'active' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `active`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/prospect_pools';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'department_ids' => 'department_ids',
        'office_ids' => 'office_ids',
        'job_ids' => 'job_ids',
        'fields' => 'fields',
        'active' => 'active',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'department_ids' => 'form',
        'office_ids' => 'form',
        'job_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
