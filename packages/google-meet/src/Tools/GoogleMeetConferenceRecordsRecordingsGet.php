<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Conference Records Recordings Get.
 *
 * Maps to the official Google Meet endpoint GET /v2/{+name}.
 */
class GoogleMeetConferenceRecordsRecordingsGet extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_conference_records_recordings_get';
    protected const DESCRIPTION = 'Conference Records Recordings Get

Official Google Meet endpoint: GET /v2/{+name}
Gets a recording by recording ID.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Meet resource names such as `spaces/abc`, `conferenceRecords/record`, `conferenceRecords/record/participants/person`, or nested recording/transcript names.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
