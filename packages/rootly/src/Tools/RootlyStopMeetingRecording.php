<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Stop a meeting recording.
 *
 * Maps to the official Rootly endpoint post /v1/meeting_recordings/{id}/stop.
 */
class RootlyStopMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_stop_meeting_recording';
    protected const DESCRIPTION = 'Stop a meeting recording

Official Rootly endpoint: POST /v1/meeting_recordings/{id}/stop

Stop an active or paused recording. The bot finishes processing, generates a transcript, and the session status transitions to completed. This is irreversible — to record again, create a new session.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/meeting_recordings/{id}/stop';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
