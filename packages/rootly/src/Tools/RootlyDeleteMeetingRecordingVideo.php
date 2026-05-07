<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete video from a meeting recording.
 *
 * Maps to the official Rootly endpoint delete /v1/meeting_recordings/{id}/delete_video.
 */
class RootlyDeleteMeetingRecordingVideo extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_meeting_recording_video';
    protected const DESCRIPTION = 'Delete video from a meeting recording

Official Rootly endpoint: DELETE /v1/meeting_recordings/{id}/delete_video

Delete only the video file from a meeting recording. The transcript, summary, and all metadata are preserved. Only non-active recordings with an attached video can have their video deleted.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Meeting Recording UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/meeting_recordings/{id}/delete_video';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
