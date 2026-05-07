<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Approve a Certificate for the Destination.
 *
 * Maps to the official Fivetran endpoint post /v1/destinations/{destinationId}/certificates.
 */
class FivetranApproveDestinationCertificate extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_approve_destination_certificate';
    protected const DESCRIPTION = 'Approve a Certificate for the Destination

Official Fivetran endpoint: POST /v1/destinations/{destinationId}/certificates

Approves a certificate, so Fivetran trusts this certificate for a destination database connection. The destination connection setup tests will fail if a non-approved certificate is provided. > NOTE: This is only required for destination connections based on the following databases: > - [MySQL](https://fivetran.com/docs/destinations/mysql#supportedimplementations) > - [PostgreSQL](https://fivetran.com/docs/destinations/postgresql#supportedimplementations) > - [SQLServer](https://fivetran.com/docs/destinations/sql-server#supportedimplementations)';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Fivetran API operation. The unique identifier for the destination within the Fivetran system.',
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
    protected const PATH = '/v1/destinations/{destinationId}/certificates';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
