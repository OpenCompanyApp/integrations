<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List candidate attribute types.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/candidate_attribute_types.
 */
class GreenhouseGetV3CandidateAttributeTypes extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_candidate_attribute_types';
    protected const DESCRIPTION = 'List candidate attribute types

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_attribute_types.';
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
        'is_draft' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `is_draft`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/candidate_attribute_types';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'active' => 'active',
        'is_draft' => 'is_draft',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
