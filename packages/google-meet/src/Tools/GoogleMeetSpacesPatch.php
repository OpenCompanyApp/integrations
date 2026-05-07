<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Spaces Patch.
 *
 * Maps to the official Google Meet endpoint PATCH /v2/{+name}.
 */
class GoogleMeetSpacesPatch extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_spaces_patch';
    protected const DESCRIPTION = 'Spaces Patch

Official Google Meet endpoint: PATCH /v2/{+name}
Updates details about a meeting space.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Meet resource names such as `spaces/abc`, `conferenceRecords/record`, `conferenceRecords/record/participants/person`, or nested recording/transcript names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Google Meet method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Meet `Space` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}
