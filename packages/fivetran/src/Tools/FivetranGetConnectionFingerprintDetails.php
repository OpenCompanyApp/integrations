<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connection Fingerprint Details.
 *
 * Maps to the official Fivetran endpoint get /v1/connections/{connectionId}/fingerprints/{hash}.
 */
class FivetranGetConnectionFingerprintDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_connection_fingerprint_details';
    protected const DESCRIPTION = 'Retrieve Connection Fingerprint Details

Official Fivetran endpoint: GET /v1/connections/{connectionId}/fingerprints/{hash}

Returns SSH fingerprint details approved for specified connection with specified hash';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'hash' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hash` from the official Fivetran API operation. The unique identifier of the fingerprint (Base64URL encoded hash of the fingerprint).',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/connections/{connectionId}/fingerprints/{hash}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
  'hash' => 'hash',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
