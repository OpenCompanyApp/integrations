<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a service dependency.
 *
 * Maps to the official FireHydrant endpoint delete /v1/service_dependencies/{service_dependency_id}.
 */
class FireHydrantDeleteServiceDependency extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_service_dependency';
    protected const DESCRIPTION = 'Delete a service dependency

Official FireHydrant endpoint: DELETE /v1/service_dependencies/{service_dependency_id}

Deletes a single service dependency';
    protected const PARAMETERS = array (
  'service_dependency_id' =>
  array (
    'type' => 'string',
    'description' => 'service_dependency_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/service_dependencies/{service_dependency_id}';
    protected const PATH_PARAMS = array (
  'service_dependency_id' => 'service_dependency_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
