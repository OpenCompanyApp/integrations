<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List Identity Verifications.
 *
 * Maps to the official Plaid endpoint post /identity_verification/list.
 */
class PlaidIdentityVerificationList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_verification_list';
    protected const DESCRIPTION = 'List Identity Verifications

Official Plaid endpoint: POST /identity_verification/list

Filter and list Identity Verifications created by your account';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity_verification/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}