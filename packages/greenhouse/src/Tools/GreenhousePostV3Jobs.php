<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create job.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/jobs.
 */
class GreenhousePostV3Jobs extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_jobs';
    protected const DESCRIPTION = 'Create job

Official Greenhouse Harvest v3 endpoint: POST /v3/jobs.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/jobs';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
