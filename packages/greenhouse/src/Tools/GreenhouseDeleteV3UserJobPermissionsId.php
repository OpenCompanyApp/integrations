<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete User Job Permission.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/user_job_permissions/{id}.
 */
class GreenhouseDeleteV3UserJobPermissionsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_user_job_permissions_id';
    protected const DESCRIPTION = 'Delete User Job Permission

Official Greenhouse Harvest v3 endpoint: DELETE /v3/user_job_permissions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/user_job_permissions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
