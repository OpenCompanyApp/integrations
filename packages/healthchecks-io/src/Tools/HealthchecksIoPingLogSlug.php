<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Send a log slug ping signal.
 *
 * Maps to the official Healthchecks.io endpoint POST /{ping_key}/{slug}/log.
 */
class HealthchecksIoPingLogSlug extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_ping_log_slug';
    protected const DESCRIPTION = 'Send a log slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}/log.';
    protected const PARAMETERS = [
        'ping_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ping key path parameter',
        ],
        'slug' => [
            'type' => 'string',
            'required' => true,
            'description' => 'slug path parameter',
        ],
        'rid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'rid query parameter',
        ],
        'create' => [
            'type' => 'string',
            'required' => false,
            'description' => 'create query parameter',
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
    protected const PATH = '/{ping_key}/{slug}/log';
    protected const PATH_PARAMS = [
        'ping_key' => 'ping_key',
        'slug' => 'slug',
    ];
    protected const QUERY_PARAMS = [
        'rid' => 'rid',
        'create' => 'create',
    ];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = false;
    protected const PING = true;
}
