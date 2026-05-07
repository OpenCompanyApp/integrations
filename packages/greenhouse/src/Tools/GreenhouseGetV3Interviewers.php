<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List interviewers.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/interviewers.
 */
class GreenhouseGetV3Interviewers extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_interviewers';
    protected const DESCRIPTION = 'List interviewers

Official Greenhouse Harvest v3 endpoint: GET /v3/interviewers.';
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
        'interview_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'user_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'scorecard_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'response_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `response_status`.',
            'enum' => [
                'needs_action',
                'declined',
                'tentative',
                'accepted',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/interviewers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'interview_ids' => 'interview_ids',
        'user_ids' => 'user_ids',
        'scorecard_ids' => 'scorecard_ids',
        'fields' => 'fields',
        'response_status' => 'response_status',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'interview_ids' => 'form',
        'user_ids' => 'form',
        'scorecard_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
