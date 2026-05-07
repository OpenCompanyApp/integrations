<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List EEOC.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/eeoc.
 */
class GreenhouseGetV3Eeoc extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_eeoc';
    protected const DESCRIPTION = 'List EEOC

Official Greenhouse Harvest v3 endpoint: GET /v3/eeoc.';
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
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'submitted_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `submitted_at`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/eeoc';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'application_ids' => 'application_ids',
        'fields' => 'fields',
        'submitted_at' => 'submitted_at',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'application_ids' => 'form',
        'fields' => 'form',
        'submitted_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
