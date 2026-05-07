<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Job Owner.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/job_owners/{id}.
 */
class GreenhouseDeleteV3JobOwnersId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_job_owners_id';
    protected const DESCRIPTION = 'Delete Job Owner

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_owners/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/job_owners/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
