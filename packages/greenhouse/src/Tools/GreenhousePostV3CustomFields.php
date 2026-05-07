<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create Custom Field.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/custom_fields.
 */
class GreenhousePostV3CustomFields extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_custom_fields';
    protected const DESCRIPTION = 'Create Custom Field

Official Greenhouse Harvest v3 endpoint: POST /v3/custom_fields.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/custom_fields';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
