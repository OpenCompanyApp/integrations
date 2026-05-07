<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch all accounting connections for the current business.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/all-connections.
 */
class RampGetAccountingAllConnectionsResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_accounting_all_connections_resource';
    protected const DESCRIPTION = 'Fetch all accounting connections for the current business

Official Ramp endpoint: GET /developer/v1/accounting/all-connections';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/all-connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
