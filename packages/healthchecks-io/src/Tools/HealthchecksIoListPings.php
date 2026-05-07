<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * List a check's logged pings.
 *
 * Maps to the official Healthchecks.io endpoint GET /checks/{uuid}/pings/.
 */
class HealthchecksIoListPings extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_list_pings';
    protected const DESCRIPTION = 'List a check\'s logged pings

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{uuid}/pings/.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/checks/{uuid}/pings/';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
