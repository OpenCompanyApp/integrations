<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Upgrade Transformation Package.
 *
 * Maps to the official Fivetran endpoint post /v1/transformations/{transformationId}/upgrade.
 */
class FivetranUpgradeTransformationPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_upgrade_transformation_package';
    protected const DESCRIPTION = 'Upgrade Transformation Package

Official Fivetran endpoint: POST /v1/transformations/{transformationId}/upgrade

Upgrades the Quickstart transformation package to latest version if a valid identifier is provided.';
    protected const PARAMETERS = array (
  'transformation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transformationId` from the official Fivetran API operation. The unique identifier for the transformation within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/transformations/{transformationId}/upgrade';
    protected const PATH_PARAMS = array (
  'transformationId' => 'transformation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
