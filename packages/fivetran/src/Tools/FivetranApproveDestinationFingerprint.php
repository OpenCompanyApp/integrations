<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Approve a Fingerprint for the Destination.
 *
 * Maps to the official Fivetran endpoint post /v1/destinations/{destinationId}/fingerprints.
 */
class FivetranApproveDestinationFingerprint extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_approve_destination_fingerprint';
    protected const DESCRIPTION = 'Approve a Fingerprint for the Destination

Official Fivetran endpoint: POST /v1/destinations/{destinationId}/fingerprints

Approves a fingerprint, enabling Fivetran to trust it for a destination database and establish connections via an SSH tunnel.';
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
    protected const PATH = '/v1/destinations/{destinationId}/fingerprints';
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
