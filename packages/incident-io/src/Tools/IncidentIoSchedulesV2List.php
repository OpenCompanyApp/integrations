<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Schedules V2.
 *
 * Maps to the official incident.io endpoint get /v2/schedules.
 */
class IncidentIoSchedulesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_list';
    protected const DESCRIPTION = 'List Schedules V2

Official incident.io endpoint: GET /v2/schedules

List configured schedules.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Note that next_shifts will only be returned when the page size is 25 or lower.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'A schedule\'s ID. This endpoint will return a list of schedules after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/schedules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
