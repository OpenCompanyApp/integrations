<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * List existing checks.
 *
 * Maps to the official Healthchecks.io endpoint GET /checks/.
 */
class HealthchecksIoListChecks extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_list_checks';
    protected const DESCRIPTION = 'List existing checks

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/.';
    protected const PARAMETERS = [
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'slug query parameter',
        ],
        'tag' => [
            'type' => 'string',
            'required' => false,
            'description' => 'tag query parameter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/checks/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'slug' => 'slug',
        'tag' => 'tag',
    ];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
