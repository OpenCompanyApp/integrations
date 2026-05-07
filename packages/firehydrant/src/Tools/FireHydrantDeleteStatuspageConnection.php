<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a Statuspage connection.
 *
 * Maps to the official FireHydrant endpoint delete /v1/integrations/statuspage/connections/{connection_id}.
 */
class FireHydrantDeleteStatuspageConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_statuspage_connection';
    protected const DESCRIPTION = 'Delete a Statuspage connection

Official FireHydrant endpoint: DELETE /v1/integrations/statuspage/connections/{connection_id}

Deletes the given Statuspage integration connection.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
