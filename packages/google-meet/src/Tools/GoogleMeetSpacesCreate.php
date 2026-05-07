<?php

namespace OpenCompany\Integrations\GoogleMeet\Tools;

/**
 * Spaces Create.
 *
 * Maps to the official Google Meet endpoint POST /v2/spaces.
 */
class GoogleMeetSpacesCreate extends AbstractGoogleMeetTool
{
    protected const NAME = 'google_meet_spaces_create';
    protected const DESCRIPTION = 'Spaces Create

Official Google Meet endpoint: POST /v2/spaces
Creates a space.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Meet `Space` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/spaces';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
