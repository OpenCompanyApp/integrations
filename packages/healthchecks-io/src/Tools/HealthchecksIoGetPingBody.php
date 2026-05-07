<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Get a ping's logged body.
 *
 * Maps to the official Healthchecks.io endpoint GET /checks/{uuid}/pings/{n}/body.
 */
class HealthchecksIoGetPingBody extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_get_ping_body';
    protected const DESCRIPTION = 'Get a ping\'s logged body

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{uuid}/pings/{n}/body.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
        'n' => [
            'type' => 'number',
            'required' => true,
            'description' => 'n path parameter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/checks/{uuid}/pings/{n}/body';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
        'n' => 'n',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
