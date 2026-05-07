<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Create meeting recording.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{incident_id}/meeting_recordings.
 */
class RootlyCreateMeetingRecording extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_meeting_recording';
    protected const DESCRIPTION = 'Create meeting recording

Official Rootly endpoint: POST /v1/incidents/{incident_id}/meeting_recordings

Invite a recording bot to the incident\'s meeting. If no previous recordings exist for the platform, a new bot is invited (session 1). If previous sessions exist, a new session is created (re-invite). The bot joins the meeting, records audio/video, and generates a transcript when the session ends.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Incident UUID',
    'required' => true,
  ),
  'platform' =>
  array (
    'type' => 'string',
    'description' => 'Meeting platform',
    'enum' =>
    array (
      0 => 'zoom',
      1 => 'google_meet',
      2 => 'microsoft_teams',
      3 => 'webex',
    ),
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/meeting_recordings';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'platform' => 'platform',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
