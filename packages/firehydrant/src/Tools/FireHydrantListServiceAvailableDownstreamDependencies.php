<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List available downstream service dependencies.
 *
 * Maps to the official FireHydrant endpoint get /v1/services/{service_id}/available_downstream_dependencies.
 */
class FireHydrantListServiceAvailableDownstreamDependencies extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_service_available_downstream_dependencies';
    protected const DESCRIPTION = 'List available downstream service dependencies

Official FireHydrant endpoint: GET /v1/services/{service_id}/available_downstream_dependencies

Retrieves all services that are available to be downstream dependencies';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services/{service_id}/available_downstream_dependencies';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
