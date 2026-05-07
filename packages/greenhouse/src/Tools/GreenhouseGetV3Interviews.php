<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List interviews.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/interviews.
 */
class GreenhouseGetV3Interviews extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_interviews';
    protected const DESCRIPTION = 'List interviews

Official Greenhouse Harvest v3 endpoint: GET /v3/interviews.';
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
        'application_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'job_interview_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'organizer_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'starts_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `starts_at`.',
        ],
        'ends_at' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `ends_at`.',
        ],
        'all_day_start_on' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `all_day_start_on`.',
        ],
        'all_day_end_on' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `all_day_end_on`.',
        ],
        'external_event_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `external_event_id`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `status`.',
            'enum' => [
                'to_be_scheduled',
                'scheduled',
                'awaiting_feedback',
                'complete',
                'skipped',
                'collect_feedback',
                'to_be_sent',
                'sent',
                'received',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/interviews';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'job_ids' => 'job_ids',
        'application_ids' => 'application_ids',
        'job_interview_ids' => 'job_interview_ids',
        'organizer_ids' => 'organizer_ids',
        'fields' => 'fields',
        'starts_at' => 'starts_at',
        'ends_at' => 'ends_at',
        'all_day_start_on' => 'all_day_start_on',
        'all_day_end_on' => 'all_day_end_on',
        'external_event_id' => 'external_event_id',
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'job_ids' => 'form',
        'application_ids' => 'form',
        'job_interview_ids' => 'form',
        'organizer_ids' => 'form',
        'fields' => 'form',
        'starts_at' => 'pipeDelimited',
        'ends_at' => 'pipeDelimited',
        'all_day_start_on' => 'pipeDelimited',
        'all_day_end_on' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
