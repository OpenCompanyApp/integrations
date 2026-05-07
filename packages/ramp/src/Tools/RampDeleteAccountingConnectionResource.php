<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Disconnect an accounting connection.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/connection.
 */
class RampDeleteAccountingConnectionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_accounting_connection_resource';
    protected const DESCRIPTION = 'Disconnect an accounting connection

Official Ramp endpoint: DELETE /developer/v1/accounting/connection

This endpoint only allows disconnecting API based connections.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/accounting/connection';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
