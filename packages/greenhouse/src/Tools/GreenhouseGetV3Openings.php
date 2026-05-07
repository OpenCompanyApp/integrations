<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List openings.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/openings.
 */
class GreenhouseGetV3Openings extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_openings';
    protected const DESCRIPTION = 'List openings

Official Greenhouse Harvest v3 endpoint: GET /v3/openings.';
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
        'job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'application_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'close_reason_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
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
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
        'open' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `open`.',
        ],
        'opening_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `opening_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/openings';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_ids' => 'job_ids',
        'application_ids' => 'application_ids',
        'close_reason_ids' => 'close_reason_ids',
        'fields' => 'fields',
        'opened_at' => 'opened_at',
        'closed_at' => 'closed_at',
        'custom_field_option_id' => 'custom_field_option_id',
        'open' => 'open',
        'opening_id' => 'opening_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_ids' => 'form',
        'application_ids' => 'form',
        'close_reason_ids' => 'form',
        'fields' => 'form',
        'opened_at' => 'pipeDelimited',
        'closed_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
