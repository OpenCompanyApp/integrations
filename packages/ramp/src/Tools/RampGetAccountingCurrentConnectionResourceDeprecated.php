<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch the current active accounting connection.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/connection.
 */
class RampGetAccountingCurrentConnectionResourceDeprecated extends AbstractRampTool
{
    protected const NAME = 'ramp_get_accounting_current_connection_resource_deprecated';
    protected const DESCRIPTION = 'Fetch the current active accounting connection

Official Ramp endpoint: GET /developer/v1/accounting/connection

This endpoint is now deprecated. Please use the `/all-connections` endpoint instead here.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
