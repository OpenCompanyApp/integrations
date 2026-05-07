<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List job posts.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/job_posts.
 */
class GreenhouseGetV3JobPosts extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_job_posts';
    protected const DESCRIPTION = 'List job posts

Official Greenhouse Harvest v3 endpoint: GET /v3/job_posts.';
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
        'job_board_ids' => [
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
        'featured' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `featured`.',
        ],
        'live' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `live`.',
        ],
        'internal' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `internal`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/job_posts';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_ids' => 'job_ids',
        'job_board_ids' => 'job_board_ids',
        'fields' => 'fields',
        'active' => 'active',
        'featured' => 'featured',
        'live' => 'live',
        'internal' => 'internal',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_ids' => 'form',
        'job_board_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
