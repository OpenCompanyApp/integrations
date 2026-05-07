<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List users.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/users.
 */
class GreenhouseGetV3Users extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_users';
    protected const DESCRIPTION = 'List users

Official Greenhouse Harvest v3 endpoint: GET /v3/users.';
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
        'agency_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'office_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'department_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'linked_candidate_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'interviewer_tag_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'employee_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
        'deactivated' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `deactivated`.',
        ],
        'primary_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `primary_email`.',
        ],
        'external_office_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `external_office_id`.',
        ],
        'external_department_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `external_department_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/users';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'agency_ids' => 'agency_ids',
        'office_ids' => 'office_ids',
        'department_ids' => 'department_ids',
        'linked_candidate_ids' => 'linked_candidate_ids',
        'interviewer_tag_ids' => 'interviewer_tag_ids',
        'fields' => 'fields',
        'employee_ids' => 'employee_ids',
        'custom_field_option_id' => 'custom_field_option_id',
        'deactivated' => 'deactivated',
        'primary_email' => 'primary_email',
        'external_office_id' => 'external_office_id',
        'external_department_id' => 'external_department_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'agency_ids' => 'form',
        'office_ids' => 'form',
        'department_ids' => 'form',
        'linked_candidate_ids' => 'form',
        'interviewer_tag_ids' => 'form',
        'fields' => 'form',
        'employee_ids' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
