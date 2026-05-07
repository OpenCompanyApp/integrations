<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List offers.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/offers.
 */
class GreenhouseGetV3Offers extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_offers';
    protected const DESCRIPTION = 'List offers

Official Greenhouse Harvest v3 endpoint: GET /v3/offers.';
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
        'application_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'candidate_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'opening_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'current_only' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `current_only`.',
        ],
        'custom_field_option_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `custom_field_option_id`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `status`.',
            'enum' => [
                'Created',
                'Accepted',
                'Rejected',
                'Deprecated',
            ],
        ],
        'resolved_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `resolved_at`.',
        ],
        'sent_on' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `sent_on`.',
        ],
        'starts_on' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `starts_on`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/offers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'application_ids' => 'application_ids',
        'job_ids' => 'job_ids',
        'candidate_ids' => 'candidate_ids',
        'opening_ids' => 'opening_ids',
        'fields' => 'fields',
        'current_only' => 'current_only',
        'custom_field_option_id' => 'custom_field_option_id',
        'status' => 'status',
        'resolved_at' => 'resolved_at',
        'sent_on' => 'sent_on',
        'starts_on' => 'starts_on',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'application_ids' => 'form',
        'job_ids' => 'form',
        'candidate_ids' => 'form',
        'opening_ids' => 'form',
        'fields' => 'form',
        'resolved_at' => 'pipeDelimited',
        'sent_on' => 'pipeDelimited',
        'starts_on' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
