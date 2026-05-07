<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowStatusPageStructure Status Pages V2.
 *
 * Maps to the official incident.io endpoint get /v2/status_page_structures/{status_page_id}.
 */
class IncidentIoStatusPagesV2ShowStatusPageStructure extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_show_status_page_structure';
    protected const DESCRIPTION = 'ShowStatusPageStructure Status Pages V2

Official incident.io endpoint: GET /v2/status_page_structures/{status_page_id}

Show the structure of a status page.

This endpoint requires a valid API key but no specific scopes. Returns the components and component groups configured on a status page. Use this to find component IDs when specifying affected components for incidents or maintenance windows.';
    protected const PARAMETERS = array (
  'status_page_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/status_page_structures/{status_page_id}';
    protected const PATH_PARAMS = array (
  'status_page_id' => 'status_page_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
