<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListStatusPageMaintenances Status Pages V2.
 *
 * Maps to the official incident.io endpoint get /v2/status_page_maintenances.
 */
class IncidentIoStatusPagesV2ListStatusPageMaintenances extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_list_status_page_maintenances';
    protected const DESCRIPTION = 'ListStatusPageMaintenances Status Pages V2

Official incident.io endpoint: GET /v2/status_page_maintenances

List status page maintenances.

This endpoint requires a valid API key but no specific scopes.';
    protected const PARAMETERS = array (
  'status_page_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page. You can find this by calling the ListStatusPages endpoint.',
    'required' => true,
  ),
  'component_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter status page maintenance windows to only those that impacted the specified component. This ID may be found by calling the ShowStatusPageStructure endpoint.',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter status page maintenance windows to only those that impacted components in the specified group. This ID may be found by calling the ShowStatusPageStructure endpoint.',
  ),
  'sub_page_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter status page maintenance windows to only those that impacted the specified sub-page. This ID may be found by calling the ShowStatusPageStructure endpoint.',
  ),
  'start_at' =>
  array (
    'type' => 'string',
    'description' => 'Filter status page maintenance windows to only those that had impacts during or after this time.',
  ),
  'end_at' =>
  array (
    'type' => 'string',
    'description' => 'Filter status page maintenance windows to only those that had impacts during or before this time.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/status_page_maintenances';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'status_page_id' => 'status_page_id',
  'component_id' => 'component_id',
  'group_id' => 'group_id',
  'sub_page_id' => 'sub_page_id',
  'start_at' => 'start_at',
  'end_at' => 'end_at',
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
