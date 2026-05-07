<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create Job Post Location.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/job_post_locations.
 */
class GreenhousePostV3JobPostLocations extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_job_post_locations';
    protected const DESCRIPTION = 'Create Job Post Location

Official Greenhouse Harvest v3 endpoint: POST /v3/job_post_locations.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/job_post_locations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
