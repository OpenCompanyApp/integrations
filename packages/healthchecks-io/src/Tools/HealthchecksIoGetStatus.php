<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

/**
 * Check Healthchecks.io database connectivity.
 *
 * Maps to the official Healthchecks.io endpoint GET /status/.
 */
class HealthchecksIoGetStatus extends AbstractHealthchecksIoTool
{
    protected const NAME = 'healthchecks_io_get_status';
    protected const DESCRIPTION = 'Check Healthchecks.io database connectivity

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/status/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/status/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;
}
