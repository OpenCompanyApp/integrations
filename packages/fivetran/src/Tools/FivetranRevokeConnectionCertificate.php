<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Revoke Connection Certificate.
 *
 * Maps to the official Fivetran endpoint delete /v1/connections/{connectionId}/certificates/{hash}.
 */
class FivetranRevokeConnectionCertificate extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_revoke_connection_certificate';
    protected const DESCRIPTION = 'Revoke Connection Certificate

Official Fivetran endpoint: DELETE /v1/connections/{connectionId}/certificates/{hash}

Revokes a certificate, so Fivetran no longer trusts it while connecting to the source database.';
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
    'description' => 'Path parameter `hash` from the official Fivetran API operation. The unique identifier of the certificate (Base64URL encoded hash of the certificate).',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/connections/{connectionId}/certificates/{hash}';
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
