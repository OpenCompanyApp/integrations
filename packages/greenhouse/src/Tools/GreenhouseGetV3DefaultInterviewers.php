<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List default interviewers.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/default_interviewers.
 */
class GreenhouseGetV3DefaultInterviewers extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_default_interviewers';
    protected const DESCRIPTION = 'List default interviewers

Official Greenhouse Harvest v3 endpoint: GET /v3/default_interviewers.';
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
        'user_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'interview_kit_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/default_interviewers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'user_ids' => 'user_ids',
        'interview_kit_ids' => 'interview_kit_ids',
        'fields' => 'fields',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'user_ids' => 'form',
        'interview_kit_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
