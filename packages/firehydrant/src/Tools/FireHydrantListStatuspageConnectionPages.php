<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List StatusPage pages for a connection.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/statuspage/connections/{connection_id}/pages.
 */
class FireHydrantListStatuspageConnectionPages extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_statuspage_connection_pages';
    protected const DESCRIPTION = 'List StatusPage pages for a connection

Official FireHydrant endpoint: GET /v1/integrations/statuspage/connections/{connection_id}/pages

Lists available page IDs for the Statuspage integration connection.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/statuspage/connections/{connection_id}/pages';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
