<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List email templates.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/email_templates.
 */
class GreenhouseGetV3EmailTemplates extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_email_templates';
    protected const DESCRIPTION = 'List email templates

Official Greenhouse Harvest v3 endpoint: GET /v3/email_templates.';
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
        'email_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `email_type`.',
            'enum' => [
                'candidate_auto_reply',
                'new_candidate',
                'new_internal_candidate',
                'new_referral',
                'new_agency_submission',
                'approved_to_start_recruiting',
                'offer_fully_approved',
                'job_closed',
                'candidate_rejection',
                'weekly_status',
                'scorecard_reminder',
                'scorecard_repeat_reminder',
                'interviewer_invite',
                'take_home_test_email',
                'daily_recruiting',
                'stage_transition',
                'scorecard_progress',
                'agency_candidate_status',
                'agency_candidate_stage',
                'candidate_email',
                'team_email',
                'none',
                'extending_offer',
                'non_admin_welcome',
                'job_admin_welcome',
                'site_admin_welcome',
                'prospect_referral_receipt',
                'candidate_referral_receipt',
                'candidate_availability_request',
                'candidate_availability_confirmation',
                'approval_request',
                'eeoc_data_request',
                'event_prospect_auto_reply',
                'job_post_request',
                'gdpr_notification',
                'stage_change_for_followers',
                'rejection_for_followers',
                'calendly_request',
                'gdpr_consent_extension',
                'agency_recruiter_assigned',
                'slack_mentions',
                'candidate_self_schedule_request',
                'sourcing_automation_step',
                'candidate_survey',
                'esignature_request',
                'scheduling_link_confirmation',
            ],
        ],
        'from_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `from_type`.',
            'enum' => [
                'user_email',
                'organization_email',
                'my_email_address',
                'inviter',
                'organizer',
                'not_applicable',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/email_templates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'fields' => 'fields',
        'email_type' => 'email_type',
        'from_type' => 'from_type',
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
