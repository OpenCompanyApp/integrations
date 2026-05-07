<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List scorecards.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/scorecards.
 */
class GreenhouseGetV3Scorecards extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_scorecards';
    protected const DESCRIPTION = 'List scorecards

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecards.';
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
        'interview_kit_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'interviewer_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'submitter_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
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
        'interviewed_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `interviewed_at`.',
        ],
        'submitted_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `submitted_at`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `status`.',
            'enum' => [
                'draft',
                'complete',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/scorecards';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'interview_kit_ids' => 'interview_kit_ids',
        'interviewer_ids' => 'interviewer_ids',
        'submitter_ids' => 'submitter_ids',
        'application_ids' => 'application_ids',
        'fields' => 'fields',
        'interviewed_at' => 'interviewed_at',
        'submitted_at' => 'submitted_at',
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'interview_kit_ids' => 'form',
        'interviewer_ids' => 'form',
        'submitter_ids' => 'form',
        'application_ids' => 'form',
        'fields' => 'form',
        'interviewed_at' => 'pipeDelimited',
        'submitted_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
