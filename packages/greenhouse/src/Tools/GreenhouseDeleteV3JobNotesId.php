<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Job Note.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/job_notes/{id}.
 */
class GreenhouseDeleteV3JobNotesId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_job_notes_id';
    protected const DESCRIPTION = 'Delete Job Note

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_notes/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/job_notes/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
