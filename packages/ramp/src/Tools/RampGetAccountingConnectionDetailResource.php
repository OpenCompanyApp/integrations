<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch an accounting connection by ID.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/connection/{connection_id}.
 */
class RampGetAccountingConnectionDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_accounting_connection_detail_resource';
    protected const DESCRIPTION = 'Fetch an accounting connection by ID

Official Ramp endpoint: GET /developer/v1/accounting/connection/{connection_id}';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connection_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/connection/{connection_id}';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
