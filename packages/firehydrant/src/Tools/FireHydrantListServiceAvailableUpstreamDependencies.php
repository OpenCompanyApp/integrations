<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List available upstream service dependencies.
 *
 * Maps to the official FireHydrant endpoint get /v1/services/{service_id}/available_upstream_dependencies.
 */
class FireHydrantListServiceAvailableUpstreamDependencies extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_service_available_upstream_dependencies';
    protected const DESCRIPTION = 'List available upstream service dependencies

Official FireHydrant endpoint: GET /v1/services/{service_id}/available_upstream_dependencies

Retrieves all services that are available to be upstream dependencies';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services/{service_id}/available_upstream_dependencies';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
