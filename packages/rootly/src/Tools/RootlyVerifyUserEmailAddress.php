<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Verifies an email address with token.
 *
 * Maps to the official Rootly endpoint post /v1/email_addresses/{id}/verify.
 */
class RootlyVerifyUserEmailAddress extends AbstractRootlyTool
{
    protected const NAME = 'rootly_verify_user_email_address';
    protected const DESCRIPTION = 'Verifies an email address with token

Official Rootly endpoint: POST /v1/email_addresses/{id}/verify

Verifies an email address using a verification token';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'token' =>
  array (
    'type' => 'string',
    'description' => 'token parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/email_addresses/{id}/verify';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'token' => 'token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
