<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Update an existing check.
 *
 * Maps to the official Healthchecks.io endpoint POST /checks/{uuid}.
 */
class HealthchecksIoUpdateCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_update_check';
    protected const DESCRIPTION = 'Update an existing check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Healthchecks.io Management API parameters.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/checks/{uuid}';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
