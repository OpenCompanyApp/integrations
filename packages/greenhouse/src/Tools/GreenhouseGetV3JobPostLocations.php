<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List job post locations.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/job_post_locations.
 */
class GreenhouseGetV3JobPostLocations extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_job_post_locations';
    protected const DESCRIPTION = 'List job post locations

Official Greenhouse Harvest v3 endpoint: GET /v3/job_post_locations.';
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
        'office_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_post_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'custom_location_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `type`.',
            'enum' => [
                'free_text',
                'office',
                'custom_list',
            ],
        ],
        'plain_text_location' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `plain_text_location`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/job_post_locations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'office_ids' => 'office_ids',
        'job_post_ids' => 'job_post_ids',
        'custom_location_ids' => 'custom_location_ids',
        'fields' => 'fields',
        'type' => 'type',
        'plain_text_location' => 'plain_text_location',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'office_ids' => 'form',
        'job_post_ids' => 'form',
        'custom_location_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
