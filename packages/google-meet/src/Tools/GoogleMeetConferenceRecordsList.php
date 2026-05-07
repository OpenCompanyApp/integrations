<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Conference Records List.
 *
 * Maps to the official Google Meet endpoint GET /v2/conferenceRecords.
 */
class GoogleMeetConferenceRecordsList extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_conference_records_list';
    protected const DESCRIPTION = 'Conference Records List

Official Google Meet endpoint: GET /v2/conferenceRecords
Lists the conference records.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Meet method. Known keys: pageToken, pageSize, filter.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/conferenceRecords';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
  2 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
