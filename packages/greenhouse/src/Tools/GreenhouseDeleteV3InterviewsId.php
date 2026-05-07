<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Interview.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/interviews/{id}.
 */
class GreenhouseDeleteV3InterviewsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_interviews_id';
    protected const DESCRIPTION = 'Delete Interview

Official Greenhouse Harvest v3 endpoint: DELETE /v3/interviews/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/interviews/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
