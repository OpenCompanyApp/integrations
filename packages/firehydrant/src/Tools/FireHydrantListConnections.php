<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List integration connections.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/connections.
 */
class FireHydrantListConnections extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_connections';
    protected const DESCRIPTION = 'List integration connections

Official FireHydrant endpoint: GET /v1/integrations/connections

List available integration connections';
    protected const PARAMETERS = array (
  'integration_slug' =>
  array (
    'type' => 'string',
    'description' => 'Only return installed integrations with the supplied slugs (types).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'integration_slug' => 'integration_slug',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
