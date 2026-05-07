<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List focus candidate attributes.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/focus_candidate_attributes.
 */
class GreenhouseGetV3FocusCandidateAttributes extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_focus_candidate_attributes';
    protected const DESCRIPTION = 'List focus candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/focus_candidate_attributes.';
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
        'job_candidate_attribute_ids' => [
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
    protected const PATH = '/v3/focus_candidate_attributes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'interview_kit_ids' => 'interview_kit_ids',
        'job_candidate_attribute_ids' => 'job_candidate_attribute_ids',
        'fields' => 'fields',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'interview_kit_ids' => 'form',
        'job_candidate_attribute_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
