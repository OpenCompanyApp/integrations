<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List Fingerprints Approved for the Destination.
 *
 * Maps to the official Fivetran endpoint get /v1/destinations/{destinationId}/fingerprints.
 */
class FivetranGetDestinationFingerprintsList extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_destination_fingerprints_list';
    protected const DESCRIPTION = 'List Fingerprints Approved for the Destination

Official Fivetran endpoint: GET /v1/destinations/{destinationId}/fingerprints

Returns the list of approved SSH fingerprints for specified destination';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destinationId` from the official Fivetran API operation. The unique identifier for the destination within the Fivetran system.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation. Paging cursor, [read more about pagination](https://fivetran.com/docs/rest-api/pagination)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation. Number of records to fetch per page. Accepts a number in the range 1..1000; the default value is 100.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/destinations/{destinationId}/fingerprints';
    protected const PATH_PARAMS = array (
  'destinationId' => 'destination_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
