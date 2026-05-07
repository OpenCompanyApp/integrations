<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a service.
 *
 * Maps to the official FireHydrant endpoint get /v1/services/{service_id}.
 */
class FireHydrantGetService extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_service';
    protected const DESCRIPTION = 'Get a service

Official FireHydrant endpoint: GET /v1/services/{service_id}

Retrieves a single service by ID';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'Service UUID or slug',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services/{service_id}';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
