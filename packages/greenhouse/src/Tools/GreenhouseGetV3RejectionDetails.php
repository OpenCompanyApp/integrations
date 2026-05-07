<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List rejection details.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/rejection_details.
 */
class GreenhouseGetV3RejectionDetails extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_rejection_details';
    protected const DESCRIPTION = 'List rejection details

Official Greenhouse Harvest v3 endpoint: GET /v3/rejection_details.';
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
        'application_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'rejection_reason_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/rejection_details';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'application_ids' => 'application_ids',
        'rejection_reason_ids' => 'rejection_reason_ids',
        'fields' => 'fields',
        'custom_field_option_id' => 'custom_field_option_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'application_ids' => 'form',
        'rejection_reason_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
