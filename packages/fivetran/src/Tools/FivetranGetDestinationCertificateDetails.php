<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Destination Certificate Details.
 *
 * Maps to the official Fivetran endpoint get /v1/destinations/{destinationId}/certificates/{hash}.
 */
class FivetranGetDestinationCertificateDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_destination_certificate_details';
    protected const DESCRIPTION = 'Retrieve Destination Certificate Details

Official Fivetran endpoint: GET /v1/destinations/{destinationId}/certificates/{hash}

Returns details of the certificate approved for the specified destination with specified certificate hash.';
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
    protected const METHOD = 'get';
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
