<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete user email address.
 *
 * Maps to the official Rootly endpoint delete /v1/email_addresses/{id}.
 */
class RootlyDeleteUserEmailAddress extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_user_email_address';
    protected const DESCRIPTION = 'Delete user email address

Official Rootly endpoint: DELETE /v1/email_addresses/{id}

Deletes a user email address';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
