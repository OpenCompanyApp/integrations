<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Lists the available and configured integrations.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/authed_providers/{integration_slug}/{connection_id}.
 */
class FireHydrantListAuthedProviders extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_authed_providers';
    protected const DESCRIPTION = 'Lists the available and configured integrations

Official FireHydrant endpoint: GET /v1/integrations/authed_providers/{integration_slug}/{connection_id}

Lists the available and configured integrations';
    protected const PARAMETERS = array (
  'integration_slug' =>
  array (
    'type' => 'string',
    'description' => 'Integration slug',
    'required' => true,
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection ID',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Query for users by name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/authed_providers/{integration_slug}/{connection_id}';
    protected const PATH_PARAMS = array (
  'integration_slug' => 'integration_slug',
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
