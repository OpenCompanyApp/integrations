<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a service.
 *
 * Maps to the official FireHydrant endpoint delete /v1/services/{service_id}.
 */
class FireHydrantDeleteService extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_service';
    protected const DESCRIPTION = 'Delete a service

Official FireHydrant endpoint: DELETE /v1/services/{service_id}

Deletes the service from FireHydrant.';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
