<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an integration connection status.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/statuses/{slug}.
 */
class FireHydrantListConnectionStatusesBySlug extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_connection_statuses_by_slug';
    protected const DESCRIPTION = 'Get an integration connection status

Official FireHydrant endpoint: GET /v1/integrations/statuses/{slug}

Retrieve a single integration connection status';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/statuses/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
