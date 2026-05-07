<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Source Metadata Public Endpoint.
 *
 * Maps to the official Fivetran endpoint get /public/connector-types.
 */
class FivetranMetadataPublicConnectors extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_metadata_public_connectors';
    protected const DESCRIPTION = 'Retrieve Source Metadata Public Endpoint

Official Fivetran endpoint: GET /public/connector-types

Returns all available source types. This endpoint provides metadata including the proper source name (‘Facebook Ads’ instead of facebook_ads), the source icon, feature tables, information about the Hybrid deployment support, information about the Authorization via API support, and links to Fivetran resources. As we update source names and icons, that metadata will automatically update within this endpoint.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/public/connector-types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
