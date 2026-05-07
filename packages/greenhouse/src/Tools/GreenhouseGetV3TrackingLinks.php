<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List tracking links.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/tracking_links.
 */
class GreenhouseGetV3TrackingLinks extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_tracking_links';
    protected const DESCRIPTION = 'List tracking links

Official Greenhouse Harvest v3 endpoint: GET /v3/tracking_links.';
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
        'source_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'referrer_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_board_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_post_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'related_post_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `token`.',
        ],
        'related_post_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `related_post_type`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/tracking_links';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_ids' => 'job_ids',
        'source_ids' => 'source_ids',
        'referrer_ids' => 'referrer_ids',
        'job_board_ids' => 'job_board_ids',
        'job_post_ids' => 'job_post_ids',
        'related_post_ids' => 'related_post_ids',
        'fields' => 'fields',
        'token' => 'token',
        'related_post_type' => 'related_post_type',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_ids' => 'form',
        'source_ids' => 'form',
        'referrer_ids' => 'form',
        'job_board_ids' => 'form',
        'job_post_ids' => 'form',
        'related_post_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
