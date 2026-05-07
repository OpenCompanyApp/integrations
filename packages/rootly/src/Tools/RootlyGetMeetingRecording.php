<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get a meeting recording.
 *
 * Maps to the official Rootly endpoint get /v1/meeting_recordings/{id}.
 */
class RootlyGetMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_meeting_recording';
    protected const DESCRIPTION = 'Get a meeting recording

Official Rootly endpoint: GET /v1/meeting_recordings/{id}

Retrieve a single meeting recording session including its status, duration, speaker count, word count, and transcript summary.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/meeting_recordings/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
