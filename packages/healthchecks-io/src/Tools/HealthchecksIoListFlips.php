<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * List a check's status changes.
 *
 * Maps to the official Healthchecks.io endpoint GET /checks/{check_id}/flips/.
 */
class HealthchecksIoListFlips extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_list_flips';
    protected const DESCRIPTION = 'List a check\'s status changes

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{check_id}/flips/.';
    protected const PARAMETERS = [
        'check_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'check id path parameter',
        ],
        'seconds' => [
            'type' => 'number',
            'required' => false,
            'description' => 'seconds query parameter',
        ],
        'start' => [
            'type' => 'number',
            'required' => false,
            'description' => 'start query parameter',
        ],
        'end' => [
            'type' => 'number',
            'required' => false,
            'description' => 'end query parameter',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/checks/{check_id}/flips/';
    protected const PATH_PARAMS = [
        'check_id' => 'check_id',
    ];
    protected const QUERY_PARAMS = [
        'seconds' => 'seconds',
        'start' => 'start',
        'end' => 'end',
    ];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
