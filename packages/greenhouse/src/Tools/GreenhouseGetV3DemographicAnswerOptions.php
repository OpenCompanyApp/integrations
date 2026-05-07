<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List demographic answer options.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/demographic_answer_options.
 */
class GreenhouseGetV3DemographicAnswerOptions extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_demographic_answer_options';
    protected const DESCRIPTION = 'List demographic answer options

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_answer_options.';
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
        'demographic_question_ids' => [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/demographic_answer_options';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'demographic_question_ids' => 'demographic_question_ids',
        'fields' => 'fields',
        'active' => 'active',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'demographic_question_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
