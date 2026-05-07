<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a service dependency.
 *
 * Maps to the official FireHydrant endpoint patch /v1/service_dependencies/{service_dependency_id}.
 */
class FireHydrantUpdateServiceDependency extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_service_dependency';
    protected const DESCRIPTION = 'Update a service dependency

Official FireHydrant endpoint: PATCH /v1/service_dependencies/{service_dependency_id}

Update the notes of the service dependency';
    protected const PARAMETERS = array (
  'service_dependency_id' =>
  array (
    'type' => 'string',
    'description' => 'service_dependency_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/service_dependencies/{service_dependency_id}';
    protected const PATH_PARAMS = array (
  'service_dependency_id' => 'service_dependency_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
