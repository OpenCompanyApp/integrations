<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Spaces End Active Conference.
 *
 * Maps to the official Google Meet endpoint POST /v2/{+name}:endActiveConference.
 */
class GoogleMeetSpacesEndActiveConference extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_spaces_end_active_conference';
    protected const DESCRIPTION = 'Spaces End Active Conference

Official Google Meet endpoint: POST /v2/{+name}:endActiveConference
Ends an active conference (if there\'s one).';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Meet resource names such as `spaces/abc`, `conferenceRecords/record`, `conferenceRecords/record/participants/person`, or nested recording/transcript names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Google Meet `EndActiveConferenceRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:endActiveConference';
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
