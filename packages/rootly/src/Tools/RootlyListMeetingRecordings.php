<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List meeting recordings.
 *
 * Maps to the official Rootly endpoint get /v1/incidents/{incident_id}/meeting_recordings.
 */
class RootlyListMeetingRecordings extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_meeting_recordings';
    protected const DESCRIPTION = 'List meeting recordings

Official Rootly endpoint: GET /v1/incidents/{incident_id}/meeting_recordings

List all meeting recording sessions for an incident. Returns recordings sorted by session number. Each recording represents one bot session with its own transcript, status, and metadata.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Incident UUID',
    'required' => true,
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'Page number',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of recordings per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/meeting_recordings';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
