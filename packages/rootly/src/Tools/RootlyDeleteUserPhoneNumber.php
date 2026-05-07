<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete user phone number.
 *
 * Maps to the official Rootly endpoint delete /v1/phone_numbers/{id}.
 */
class RootlyDeleteUserPhoneNumber extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_user_phone_number';
    protected const DESCRIPTION = 'Delete user phone number

Official Rootly endpoint: DELETE /v1/phone_numbers/{id}

Deletes a user phone number';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/phone_numbers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
