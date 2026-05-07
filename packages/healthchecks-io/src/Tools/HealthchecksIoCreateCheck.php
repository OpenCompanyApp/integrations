<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Create a new check.
 *
 * Maps to the official Healthchecks.io endpoint POST /checks/.
 */
class HealthchecksIoCreateCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_create_check';
    protected const DESCRIPTION = 'Create a new check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Healthchecks.io Management API parameters.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/checks/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
