<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Show user email address.
 *
 * Maps to the official Rootly endpoint get /v1/email_addresses/{id}.
 */
class RootlyShowUserEmailAddress extends AbstractRootlyTool
{
    protected const NAME = 'rootly_show_user_email_address';
    protected const DESCRIPTION = 'Show user email address

Official Rootly endpoint: GET /v1/email_addresses/{id}

Retrieves a specific user email address';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/email_addresses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
