<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a System Key.
 *
 * Maps to the official Fivetran endpoint delete /v1/system-keys/{keyId}.
 */
class FivetranDeleteSystemKey extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_system_key';
    protected const DESCRIPTION = 'Delete a System Key

Official Fivetran endpoint: DELETE /v1/system-keys/{keyId}

Deletes a system key from your Fivetran account.';
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
    protected const METHOD = 'delete';
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
