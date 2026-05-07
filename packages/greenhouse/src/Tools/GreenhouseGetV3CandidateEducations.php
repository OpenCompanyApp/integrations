<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List candidate educations.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/candidate_educations.
 */
class GreenhouseGetV3CandidateEducations extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_candidate_educations';
    protected const DESCRIPTION = 'List candidate educations

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_educations.';
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
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'start_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `start_at`.',
        ],
        'end_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `end_at`.',
        ],
        'latest' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `latest`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/candidate_educations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'candidate_ids' => 'candidate_ids',
        'fields' => 'fields',
        'start_at' => 'start_at',
        'end_at' => 'end_at',
        'latest' => 'latest',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'candidate_ids' => 'form',
        'fields' => 'form',
        'start_at' => 'pipeDelimited',
        'end_at' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
