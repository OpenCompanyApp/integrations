<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Revoke Destination Certificate.
 *
 * Maps to the official Fivetran endpoint delete /v1/destinations/{destinationId}/certificates/{hash}.
 */
class FivetranRevokeDestinationCertificate extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_revoke_destination_certificate';
    protected const DESCRIPTION = 'Revoke Destination Certificate

Official Fivetran endpoint: DELETE /v1/destinations/{destinationId}/certificates/{hash}

Revokes a certificate, so Fivetran no longer trusts it while connecting to the destination database.';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Fivetran API operation. The unique identifier for the destination within the Fivetran system.',
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
    protected const PATH = '/v1/destinations/{destinationId}/certificates/{hash}';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
  'hash' => 'hash',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
