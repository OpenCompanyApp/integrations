<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a service.
 *
 * Maps to the official FireHydrant endpoint patch /v1/services/{service_id}.
 */
class FireHydrantUpdateService extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_service';
    protected const DESCRIPTION = 'Update a service

Official FireHydrant endpoint: PATCH /v1/services/{service_id}

Update a services attributes, you may also add or remove functionalities from the service as well.
Note: You may not remove or add individual label key/value pairs. You must include the entire object to override label values.';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
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
    protected const PATH = '/v1/services/{service_id}';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
