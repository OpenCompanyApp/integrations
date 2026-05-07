<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Pause a meeting recording.
 *
 * Maps to the official Rootly endpoint post /v1/meeting_recordings/{id}/pause.
 */
class RootlyPauseMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_pause_meeting_recording';
    protected const DESCRIPTION = 'Pause a meeting recording

Official Rootly endpoint: POST /v1/meeting_recordings/{id}/pause

Pause an active recording session. The bot remains in the meeting but stops capturing audio/video. Use the resume endpoint to continue recording.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/meeting_recordings/{id}/pause';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
