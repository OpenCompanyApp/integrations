<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a service dependency.
 *
 * Maps to the official FireHydrant endpoint get /v1/service_dependencies/{service_dependency_id}.
 */
class FireHydrantGetServiceDependency extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_service_dependency';
    protected const DESCRIPTION = 'Get a service dependency

Official FireHydrant endpoint: GET /v1/service_dependencies/{service_dependency_id}

Retrieves a single service dependency by ID';
    protected const PARAMETERS = array (
  'service_dependency_id' =>
  array (
    'type' => 'string',
    'description' => 'service_dependency_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
