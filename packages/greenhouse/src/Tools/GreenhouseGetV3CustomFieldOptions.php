<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List custom field options.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/custom_field_options.
 */
class GreenhouseGetV3CustomFieldOptions extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_custom_field_options';
    protected const DESCRIPTION = 'List custom field options

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_field_options.';
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
        'custom_field_ids' => [
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
        'custom_field_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `custom_field_key`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/custom_field_options';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'custom_field_ids' => 'custom_field_ids',
        'fields' => 'fields',
        'active' => 'active',
        'custom_field_key' => 'custom_field_key',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'custom_field_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
