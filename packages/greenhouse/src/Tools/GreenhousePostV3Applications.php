<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create Application.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/applications.
 */
class GreenhousePostV3Applications extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_applications';
    protected const DESCRIPTION = 'Create Application

Official Greenhouse Harvest v3 endpoint: POST /v3/applications.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/applications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
