<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * List attachments.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint GET /v3/attachments.
 */
class GreenhouseGetV3Attachments extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_get_v3_attachments';
    protected const DESCRIPTION = 'List attachments

Official Greenhouse Harvest v3 endpoint: GET /v3/attachments.';
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
        'candidate_ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list',
        ],
        'fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Comma separated list of fields to return',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `type`.',
            'enum' => [
                'resume',
                'cover_letter',
                'take_home_test',
                'offer_packet',
                'offer_letter',
                'signed_offer_letter',
                'other',
                'form_attachment',
                'midfunnel_agreement',
                'automated_agreement',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/attachments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'ids' => 'ids',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'application_ids' => 'application_ids',
        'candidate_ids' => 'candidate_ids',
        'fields' => 'fields',
        'type' => 'type',
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [
        'ids' => 'form',
        'created_at' => 'pipeDelimited',
        'updated_at' => 'pipeDelimited',
        'application_ids' => 'form',
        'candidate_ids' => 'form',
        'fields' => 'form',
    ];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
