<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a service dependency.
 *
 * Maps to the official FireHydrant endpoint post /v1/service_dependencies.
 */
class FireHydrantCreateServiceDependency extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_service_dependency';
    protected const DESCRIPTION = 'Create a service dependency

Official FireHydrant endpoint: POST /v1/service_dependencies

Creates a service dependency relationship between two services';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/service_dependencies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
