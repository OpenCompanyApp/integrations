<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List applications.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/applications.
 */
class GreenhouseGetV3Applications extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_applications';
    protected const DESCRIPTION = 'List applications

Official Greenhouse Harvest v3 endpoint: GET /v3/applications.';
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
        'candidate_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'prospective_job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_post_ids' => [
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
        'stage_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `status`.',
            'enum' => [
                'rejected',
                'paused',
                'completed',
                'unvisited',
                'hired',
                'converted',
                'active',
            ],
        ],
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
        'last_activity_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `last_activity_at`.',
        ],
        'prospect' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `prospect`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/applications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'candidate_ids' => 'candidate_ids',
        'job_ids' => 'job_ids',
        'prospective_job_ids' => 'prospective_job_ids',
        'job_post_ids' => 'job_post_ids',
        'source_ids' => 'source_ids',
        'referrer_ids' => 'referrer_ids',
        'stage_ids' => 'stage_ids',
        'fields' => 'fields',
        'status' => 'status',
        'custom_field_option_id' => 'custom_field_option_id',
        'last_activity_at' => 'last_activity_at',
        'prospect' => 'prospect',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'candidate_ids' => 'form',
        'job_ids' => 'form',
        'prospective_job_ids' => 'form',
        'job_post_ids' => 'form',
        'source_ids' => 'form',
        'referrer_ids' => 'form',
        'stage_ids' => 'form',
        'fields' => 'form',
        'last_activity_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
