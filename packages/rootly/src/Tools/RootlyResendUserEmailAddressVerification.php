<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Resends verification email.
 *
 * Maps to the official Rootly endpoint post /v1/email_addresses/{id}/resend_verification.
 */
class RootlyResendUserEmailAddressVerification extends AbstractRootlyTool
{
    protected const NAME = 'rootly_resend_user_email_address_verification';
    protected const DESCRIPTION = 'Resends verification email

Official Rootly endpoint: POST /v1/email_addresses/{id}/resend_verification

Resends verification email for an email address';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/email_addresses/{id}/resend_verification';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
