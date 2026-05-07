<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List job interviews.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/job_interviews.
 */
class GreenhouseGetV3JobInterviews extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_job_interviews';
    protected const DESCRIPTION = 'List job interviews

Official Greenhouse Harvest v3 endpoint: GET /v3/job_interviews.';
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
        'job_interview_stage_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_ids' => [
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
        'scheduling_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `scheduling_type`.',
            'enum' => [
                'none',
                'needs_scheduling',
                'take_home_test',
                'offer',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/job_interviews';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_interview_stage_ids' => 'job_interview_stage_ids',
        'job_ids' => 'job_ids',
        'fields' => 'fields',
        'active' => 'active',
        'scheduling_type' => 'scheduling_type',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_interview_stage_ids' => 'form',
        'job_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
