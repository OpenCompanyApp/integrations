<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Approve a Fingerprint for the Connection.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/fingerprints.
 */
class FivetranApproveConnectionFingerprint extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_approve_connection_fingerprint';
    protected const DESCRIPTION = 'Approve a Fingerprint for the Connection

Official Fivetran endpoint: POST /v1/connections/{connectionId}/fingerprints

Approves a fingerprint, enabling Fivetran to trust it for a source database and establish connections via an SSH tunnel.';
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
    protected const PATH = '/v1/connections/{connectionId}/fingerprints';
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
