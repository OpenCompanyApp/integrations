<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Source Metadata.
 *
 * Maps to the official Fivetran endpoint get /v1/metadata/connector-types.
 */
class FivetranMetadataConnectors extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_metadata_connectors';
    protected const DESCRIPTION = 'Retrieve Source Metadata

Official Fivetran endpoint: GET /v1/metadata/connector-types

Returns all available source types within your Fivetran account. This endpoint makes it easier to display Fivetran connectors within your application because it provides metadata including the proper source name (\'Facebook Ads\' instead of \'facebook_ads\'), the source icon, information about the Hybrid deployment support, and links to Fivetran resources. As we update source names and icons, that metadata will automatically update within this endpoint';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/metadata/connector-types';
    protected const PATH_PARAMS = array (
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
