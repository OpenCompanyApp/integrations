<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Resume a meeting recording.
 *
 * Maps to the official Rootly endpoint post /v1/meeting_recordings/{id}/resume.
 */
class RootlyResumeMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_resume_meeting_recording';
    protected const DESCRIPTION = 'Resume a meeting recording

Official Rootly endpoint: POST /v1/meeting_recordings/{id}/resume

Resume a paused recording session. The bot continues capturing audio/video from the meeting.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/meeting_recordings/{id}/resume';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
