<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Send a exit status uuid ping signal.
 *
 * Maps to the official Healthchecks.io endpoint POST /{uuid}/{exit_status}.
 */
class HealthchecksIoPingExitStatusUuid extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_ping_exit_status_uuid';
    protected const DESCRIPTION = 'Send a exit status uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/{exit_status}.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
        ],
        'exit_status' => [
            'type' => 'number',
            'required' => true,
            'description' => 'exit status path parameter',
        ],
        'rid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'rid query parameter',
        ],
        'http_method' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
            'enum' => ['HEAD', 'GET', 'POST'],
        ],
        'body_text' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional diagnostic text body for POST ping requests.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/{uuid}/{exit_status}';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
        'exit_status' => 'exit_status',
    ];
    protected const QUERY_PARAMS = [
        'rid' => 'rid',
    ];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = false;
    protected const PING = true;
}
