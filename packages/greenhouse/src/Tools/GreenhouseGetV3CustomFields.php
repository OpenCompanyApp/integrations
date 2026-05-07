<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List custom fields.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/custom_fields.
 */
class GreenhouseGetV3CustomFields extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_custom_fields';
    protected const DESCRIPTION = 'List custom fields

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_fields.';
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
        'field_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `field_type`.',
            'enum' => [
                'job',
                'opening',
                'standard',
                'offer',
                'compensation_frequency',
                'candidate',
                'referral_question',
                'application',
                'rejection_question',
                'form',
                'agency_question',
                'user_attribute',
            ],
        ],
        'active' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `active`.',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `name`.',
        ],
        'name_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `name_key`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/custom_fields';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'field_type' => 'field_type',
        'active' => 'active',
        'name' => 'name',
        'name_key' => 'name_key',
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
