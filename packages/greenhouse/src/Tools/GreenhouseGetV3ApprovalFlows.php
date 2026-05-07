<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List approval flows.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/approval_flows.
 */
class GreenhouseGetV3ApprovalFlows extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_approval_flows';
    protected const DESCRIPTION = 'List approval flows

Official Greenhouse Harvest v3 endpoint: GET /v3/approval_flows.';
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
        'job_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'offer_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'approval_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `approval_type`.',
            'enum' => [
                'open_job',
                'offer_job',
                'offer_candidate',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/approval_flows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_ids' => 'job_ids',
        'offer_ids' => 'offer_ids',
        'fields' => 'fields',
        'approval_type' => 'approval_type',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_ids' => 'form',
        'offer_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
