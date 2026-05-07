<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListScheduleEntries Schedules V2.
 *
 * Maps to the official incident.io endpoint get /v2/schedule_entries.
 */
class IncidentIoSchedulesV2ListScheduleEntries extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_list_schedule_entries';
    protected const DESCRIPTION = 'ListScheduleEntries Schedules V2

Official incident.io endpoint: GET /v2/schedule_entries

Get a list of schedule entries. The endpoint will return all entries that overlap with the given window, if one is provided.';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the schedule to get entries for.',
    'required' => true,
  ),
  'entry_window_start' =>
  array (
    'type' => 'string',
    'description' => 'The start of the window to get entries for.',
  ),
  'entry_window_end' =>
  array (
    'type' => 'string',
    'description' => 'The end of the window to get entries for.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/schedule_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'schedule_id' => 'schedule_id',
  'entry_window_start' => 'entry_window_start',
  'entry_window_end' => 'entry_window_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
