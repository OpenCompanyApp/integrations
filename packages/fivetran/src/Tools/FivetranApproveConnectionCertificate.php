<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Approve a Certificate for the Connection.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/certificates.
 */
class FivetranApproveConnectionCertificate extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_approve_connection_certificate';
    protected const DESCRIPTION = 'Approve a Certificate for the Connection

Official Fivetran endpoint: POST /v1/connections/{connectionId}/certificates

Approves a certificate, so Fivetran trusts this certificate for a source database connection. The connection setup tests will fail if a non-approved certificate is provided. > NOTE: This is only required for source connections based on the following databases: > - [MySQL](https://fivetran.com/docs/connectors/databases/mysql#supportedservices) > - [PostgreSQL](https://fivetran.com/docs/connectors/databases/postgresql#supportedservices) > - [SQLServer](https://fivetran.com/docs/connectors/databases/sql-server#supportedservices)';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
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
    protected const PATH = '/v1/connections/{connectionId}/certificates';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
