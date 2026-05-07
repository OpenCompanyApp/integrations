<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Convert a prospect to a candidate.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/applications/{id}/convert_to_candidate.
 */
class GreenhousePostV3ApplicationsIdConvertToCandidate extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_applications_id_convert_to_candidate';
    protected const DESCRIPTION = 'Convert a prospect to a candidate

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/convert_to_candidate.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/applications/{id}/convert_to_candidate';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
