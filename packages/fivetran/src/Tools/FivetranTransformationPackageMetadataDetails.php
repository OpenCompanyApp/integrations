<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve a Quickstart Package Metadata Details.
 *
 * Maps to the official Fivetran endpoint get /v1/transformations/package-metadata/{package_definition_id}.
 */
class FivetranTransformationPackageMetadataDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_transformation_package_metadata_details';
    protected const DESCRIPTION = 'Retrieve a Quickstart Package Metadata Details

Official Fivetran endpoint: GET /v1/transformations/package-metadata/{package_definition_id}

Returns the metadata details of the Quickstart transformation package if a valid identifier is provided.';
    protected const PARAMETERS = array (
  'package_definition_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `package_definition_id` from the official Fivetran API operation. The unique identifier for the Quickstart transformation package definition within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/transformations/package-metadata/{package_definition_id}';
    protected const PATH_PARAMS = array (
  'package_definition_id' => 'package_definition_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
