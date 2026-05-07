<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List future job permissions.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/future_job_permissions.
 */
class GreenhouseGetV3FutureJobPermissions extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_future_job_permissions';
    protected const DESCRIPTION = 'List future job permissions

Official Greenhouse Harvest v3 endpoint: GET /v3/future_job_permissions.';
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
        'user_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'role_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'external_department_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `external_department_id`.',
        ],
        'external_office_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `external_office_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/future_job_permissions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'department_ids' => 'department_ids',
        'office_ids' => 'office_ids',
        'user_ids' => 'user_ids',
        'role_ids' => 'role_ids',
        'fields' => 'fields',
        'external_department_id' => 'external_department_id',
        'external_office_id' => 'external_office_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'department_ids' => 'form',
        'office_ids' => 'form',
        'user_ids' => 'form',
        'role_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
