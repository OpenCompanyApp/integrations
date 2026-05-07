<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Delete a check.
 *
 * Maps to the official Healthchecks.io endpoint DELETE /checks/{uuid}.
 */
class HealthchecksIoDeleteCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_delete_check';
    protected const DESCRIPTION = 'Delete a check

Official Healthchecks.io endpoint: DELETE https://healthchecks.io/api/v3/checks/{uuid}.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/checks/{uuid}';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
