<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Future Job Permission.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/future_job_permissions/{id}.
 */
class GreenhouseDeleteV3FutureJobPermissionsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_future_job_permissions_id';
    protected const DESCRIPTION = 'Delete Future Job Permission

Official Greenhouse Harvest v3 endpoint: DELETE /v3/future_job_permissions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/future_job_permissions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
