<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Job Hiring Manager.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/job_hiring_managers/{id}.
 */
class GreenhouseDeleteV3JobHiringManagersId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_job_hiring_managers_id';
    protected const DESCRIPTION = 'Delete Job Hiring Manager

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_hiring_managers/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/job_hiring_managers/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
