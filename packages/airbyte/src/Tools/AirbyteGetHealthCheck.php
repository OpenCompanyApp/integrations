<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Health Check.
 *
 * Maps to the official Airbyte endpoint get /health.
 */
class AirbyteGetHealthCheck extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_health_check';
    protected const DESCRIPTION = 'Health Check

Official Airbyte endpoint: GET /health';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/health';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
