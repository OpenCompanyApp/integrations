<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Conference Records Participants List.
 *
 * Maps to the official Google Meet endpoint GET /v2/{+parent}/participants.
 */
class GoogleMeetConferenceRecordsParticipantsList extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_conference_records_participants_list';
    protected const DESCRIPTION = 'Conference Records Participants List

Official Google Meet endpoint: GET /v2/{+parent}/participants
Lists the participants in a conference record.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Google Meet resource names such as `spaces/abc`, `conferenceRecords/record`, `conferenceRecords/record/participants/person`, or nested recording/transcript names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Meet method. Known keys: pageSize, filter, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/{+parent}/participants';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'filter',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
