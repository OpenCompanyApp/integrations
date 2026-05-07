<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a service link.
 *
 * Maps to the official FireHydrant endpoint delete /v1/services/{service_id}/service_links/{remote_id}.
 */
class FireHydrantDeleteServiceLink extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_service_link';
    protected const DESCRIPTION = 'Delete a service link

Official FireHydrant endpoint: DELETE /v1/services/{service_id}/service_links/{remote_id}

Deletes a service link from FireHydrant.';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
    'required' => true,
  ),
  'remote_id' =>
  array (
    'type' => 'string',
    'description' => 'The external service ID which can be found in the JSON
from GET services/:service_id endpoint under
functionalities > external_resources > remote_id',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/services/{service_id}/service_links/{remote_id}';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
  'remote_id' => 'remote_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
