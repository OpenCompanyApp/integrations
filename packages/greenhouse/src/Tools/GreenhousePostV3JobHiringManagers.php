<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create Job Hiring Manager.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/job_hiring_managers.
 */
class GreenhousePostV3JobHiringManagers extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_job_hiring_managers';
    protected const DESCRIPTION = 'Create Job Hiring Manager

Official Greenhouse Harvest v3 endpoint: POST /v3/job_hiring_managers.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/job_hiring_managers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
