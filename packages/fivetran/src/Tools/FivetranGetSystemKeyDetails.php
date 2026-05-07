<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve System Key Details.
 *
 * Maps to the official Fivetran endpoint get /v1/system-keys/{keyId}.
 */
class FivetranGetSystemKeyDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_system_key_details';
    protected const DESCRIPTION = 'Retrieve System Key Details

Official Fivetran endpoint: GET /v1/system-keys/{keyId}

Retrieves a system key object within your Fivetran account.';
    protected const PARAMETERS = array (
  'key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `keyId` from the official Fivetran API operation. The unique identifier for the system key within your Fivetran account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/system-keys/{keyId}';
    protected const PATH_PARAMS = array (
  'keyId' => 'key_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
