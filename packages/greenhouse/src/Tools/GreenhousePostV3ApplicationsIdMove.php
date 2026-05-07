<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Move an application to a different stage within the same job or transfer to another job.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/applications/{id}/move.
 */
class GreenhousePostV3ApplicationsIdMove extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_applications_id_move';
    protected const DESCRIPTION = 'Move an application to a different stage within the same job or transfer to another job

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/move.';
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
    protected const PATH = '/v3/applications/{id}/move';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
