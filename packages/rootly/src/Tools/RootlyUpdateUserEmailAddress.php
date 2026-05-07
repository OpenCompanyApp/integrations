<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update user email address.
 *
 * Maps to the official Rootly endpoint put /v1/email_addresses/{id}.
 */
class RootlyUpdateUserEmailAddress extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_user_email_address';
    protected const DESCRIPTION = 'Update user email address

Official Rootly endpoint: PUT /v1/email_addresses/{id}

Updates a user email address';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/email_addresses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
