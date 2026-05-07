<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List Webhooks **Greenhouse Partners Exclusive**.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/webhooks.
 */
class GreenhouseGetV3Webhooks extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_webhooks';
    protected const DESCRIPTION = 'List Webhooks **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: GET /v3/webhooks.';
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
        'last_delivered' => [
            'type' => 'object',
            'required' => false,
            'description' => 'query parameter `last_delivered`.',
        ],
        'event_action_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `event_action_type`.',
            'enum' => [
                'application_updated',
                'candidate_anonymized',
                'candidate_stage_change',
                'delete_application',
                'delete_candidate',
                'department_deleted',
                'hire_candidate',
                'interview_deleted',
                'job_approved',
                'job_created',
                'job_deleted',
                'job_interview_stage_deleted',
                'job_post_created',
                'job_post_deleted',
                'job_post_updated',
                'job_updated',
                'merge_candidate',
                'new_candidate_application',
                'new_prospect_application',
                'offer_approved',
                'offer_created',
                'offer_deleted',
                'offer_updated',
                'office_deleted',
                'reject_candidate',
                'scorecard_deleted',
                'unhire_candidate',
                'unreject_candidate',
                'update_candidate',
            ],
        ],
        'deactivated' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `deactivated`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/webhooks';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'last_delivered' => 'last_delivered',
        'event_action_type' => 'event_action_type',
        'deactivated' => 'deactivated',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'fields' => 'form',
        'last_delivered' => 'pipeDelimited',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
