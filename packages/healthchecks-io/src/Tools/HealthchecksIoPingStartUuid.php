<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Send a start uuid ping signal.
 *
 * Maps to the official Healthchecks.io endpoint POST /{uuid}/start.
 */
class HealthchecksIoPingStartUuid extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_ping_start_uuid';
    protected const DESCRIPTION = 'Send a start uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/start.';
    protected const PARAMETERS = [
        'uuid' => [
            'type' => 'string',
            'required' => true,
            'description' => 'uuid path parameter',
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
    protected const PATH = '/{uuid}/start';
    protected const PATH_PARAMS = [
        'uuid' => 'uuid',
    ];
    protected const QUERY_PARAMS = [
        'rid' => 'rid',
    ];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = false;
    protected const PING = true;
}
