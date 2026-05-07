<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a meeting recording.
 *
 * Maps to the official Rootly endpoint delete /v1/meeting_recordings/{id}.
 */
class RootlyDeleteMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_meeting_recording';
    protected const DESCRIPTION = 'Delete a meeting recording

Official Rootly endpoint: DELETE /v1/meeting_recordings/{id}

Delete a meeting recording. Only completed or failed recordings can be deleted. Active recordings (pending, recording, paused) must be stopped first.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
