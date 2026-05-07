<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Rotate a System Key.
 *
 * Maps to the official Fivetran endpoint post /v1/system-keys/{keyId}/rotate.
 */
class FivetranRotateSystemKey extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_rotate_system_key';
    protected const DESCRIPTION = 'Rotate a System Key

Official Fivetran endpoint: POST /v1/system-keys/{keyId}/rotate

Updates the secret value and expired_at date for an existing system key within your Fivetran account.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/system-keys/{keyId}/rotate';
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
