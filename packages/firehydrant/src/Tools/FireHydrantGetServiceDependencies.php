<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List dependencies for a service.
 *
 * Maps to the official FireHydrant endpoint get /v1/services/{service_id}/dependencies.
 */
class FireHydrantGetServiceDependencies extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_service_dependencies';
    protected const DESCRIPTION = 'List dependencies for a service

Official FireHydrant endpoint: GET /v1/services/{service_id}/dependencies

Retrieves a service\'s dependencies';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
  'flatten' =>
  array (
    'type' => 'boolean',
    'description' => 'If true, returns all dependencies in one array. If false, splits dependencies into different arrays for child and parent dependencies',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services/{service_id}/dependencies';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
  'flatten' => 'flatten',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
