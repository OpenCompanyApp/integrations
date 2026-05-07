<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Leave a meeting call.
 *
 * Maps to the official Rootly endpoint post /v1/meeting_recordings/{id}/leave.
 */
class RootlyLeaveMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_leave_meeting_recording';
    protected const DESCRIPTION = 'Leave a meeting call

Official Rootly endpoint: POST /v1/meeting_recordings/{id}/leave

Remove the recording bot from the meeting entirely. Unlike stop, this immediately disconnects the bot. The session will transition to analyzing and then completed once transcript processing finishes.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/meeting_recordings/{id}/leave';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
