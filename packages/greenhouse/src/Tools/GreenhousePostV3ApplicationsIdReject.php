<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Reject Application.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/applications/{id}/reject.
 */
class GreenhousePostV3ApplicationsIdReject extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_applications_id_reject';
    protected const DESCRIPTION = 'Reject Application

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/reject.';
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
    protected const PATH = '/v3/applications/{id}/reject';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
