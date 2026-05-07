<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a Statuspage connection.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/statuspage/connections/{connection_id}.
 */
class FireHydrantGetStatuspageConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_statuspage_connection';
    protected const DESCRIPTION = 'Get a Statuspage connection

Official FireHydrant endpoint: GET /v1/integrations/statuspage/connections/{connection_id}

Retrieve the information about the Statuspage connection.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/statuspage/connections/{connection_id}';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
