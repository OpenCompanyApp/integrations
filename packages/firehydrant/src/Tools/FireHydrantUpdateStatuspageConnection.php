<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a Statuspage connection.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/statuspage/connections/{connection_id}.
 */
class FireHydrantUpdateStatuspageConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_statuspage_connection';
    protected const DESCRIPTION = 'Update a Statuspage connection

Official FireHydrant endpoint: PATCH /v1/integrations/statuspage/connections/{connection_id}

Update the given Statuspage integration connection.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection UUID',
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
    protected const PATH = '/v1/integrations/statuspage/connections/{connection_id}';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
