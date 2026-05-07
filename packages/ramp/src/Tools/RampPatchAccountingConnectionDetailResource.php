<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update an accounting connection.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/connection/{connection_id}.
 */
class RampPatchAccountingConnectionDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_accounting_connection_detail_resource';
    protected const DESCRIPTION = 'Update an accounting connection

Official Ramp endpoint: PATCH /developer/v1/accounting/connection/{connection_id}

This endpoint is restricted to Accounting API based connections.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connection_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/connection/{connection_id}';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
