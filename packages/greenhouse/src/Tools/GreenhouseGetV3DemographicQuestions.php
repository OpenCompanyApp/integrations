<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List demographic questions.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/demographic_questions.
 */
class GreenhouseGetV3DemographicQuestions extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_demographic_questions';
    protected const DESCRIPTION = 'List demographic questions

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_questions.';
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
        'demographic_question_set_ids' => [
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
        'required' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `required`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/demographic_questions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'demographic_question_set_ids' => 'demographic_question_set_ids',
        'fields' => 'fields',
        'active' => 'active',
        'required' => 'required',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'demographic_question_set_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
