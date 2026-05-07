<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Reactivate a previously unlinked accounting connection.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/connection/{connection_id}/reactivate.
 */
class RampPostReactivateConnectionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_reactivate_connection_resource';
    protected const DESCRIPTION = 'Reactivate a previously unlinked accounting connection

Official Ramp endpoint: POST /developer/v1/accounting/connection/{connection_id}/reactivate

This endpoint allows reactivating a previously disconnected accounting connection by changing its status back to linked. This preserves all previous accounting field configurations and settings. The business must not have any other active accounting connections.';
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
    'required' => false,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/connection/{connection_id}/reactivate';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
