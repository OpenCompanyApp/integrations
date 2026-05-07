<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List scorecard question candidate attributes.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/scorecard_question_candidate_attributes.
 */
class GreenhouseGetV3ScorecardQuestionCandidateAttributes extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_scorecard_question_candidate_attributes';
    protected const DESCRIPTION = 'List scorecard question candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_question_candidate_attributes.';
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
        'scorecard_question_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'focus_candidate_attribute_ids' => [
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
    protected const PATH = '/v3/scorecard_question_candidate_attributes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'scorecard_question_ids' => 'scorecard_question_ids',
        'focus_candidate_attribute_ids' => 'focus_candidate_attribute_ids',
        'fields' => 'fields',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'scorecard_question_ids' => 'form',
        'focus_candidate_attribute_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
