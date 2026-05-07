<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Get a single check by UUID or unique key.
 *
 * Maps to the official Healthchecks.io endpoint GET /checks/{check_id}.
 */
class HealthchecksIoGetCheck extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_get_check';
    protected const DESCRIPTION = 'Get a single check by UUID or unique key

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{check_id}.';
    protected const PARAMETERS = [
        'check_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'check id path parameter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/checks/{check_id}';
    protected const PATH_PARAMS = [
        'check_id' => 'check_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
