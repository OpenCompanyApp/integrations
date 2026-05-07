<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List jobs.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/jobs.
 */
class GreenhouseGetV3Jobs extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_jobs';
    protected const DESCRIPTION = 'List jobs

Official Greenhouse Harvest v3 endpoint: GET /v3/jobs.';
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
        'opened_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `opened_at`.',
        ],
        'closed_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `closed_at`.',
        ],
        'requisition_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `requisition_id`.',
        ],
        'department_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `department_id`.',
        ],
        'office_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `office_id`.',
        ],
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
        'confidential' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `confidential`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `status`.',
            'enum' => [
                'open',
                'draft',
                'closed',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/jobs';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'opened_at' => 'opened_at',
        'closed_at' => 'closed_at',
        'requisition_id' => 'requisition_id',
        'department_id' => 'department_id',
        'office_id' => 'office_id',
        'custom_field_option_id' => 'custom_field_option_id',
        'confidential' => 'confidential',
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'fields' => 'form',
        'opened_at' => 'pipeDelimited',
        'closed_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
