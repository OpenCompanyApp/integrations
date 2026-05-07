<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Quickstart Package Metadata.
 *
 * Maps to the official Fivetran endpoint get /v1/transformations/package-metadata.
 */
class FivetranTransformationPackageMetadataList extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_transformation_package_metadata_list';
    protected const DESCRIPTION = 'List All Quickstart Package Metadata

Official Fivetran endpoint: GET /v1/transformations/package-metadata

Returns a list of available Quickstart transformation package metadata details.';
    protected const PARAMETERS = array (
  'service' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `service` from the official Fivetran API operation. Specify the service identifier to filter Quickstart packages by connection service',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Fivetran API operation. Specify the package name to filter Quickstart packages by name',
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
    protected const PATH = '/v1/transformations/package-metadata';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'service' => 'service',
  'name' => 'name',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
