<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an integration connection status.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/statuses/{slug}/{by_connection_id}.
 */
class FireHydrantListConnectionStatusesBySlugAndId extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_connection_statuses_by_slug_and_id';
    protected const DESCRIPTION = 'Get an integration connection status

Official FireHydrant endpoint: GET /v1/integrations/statuses/{slug}/{by_connection_id}

Retrieve a single integration connection status';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
  'by_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'by_connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/statuses/{slug}/{by_connection_id}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
  'by_connection_id' => 'by_connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
