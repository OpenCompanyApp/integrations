<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a new Identity Verification.
 *
 * Maps to the official Plaid endpoint post /identity_verification/create.
 */
class PlaidIdentityVerificationCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_verification_create';
    protected const DESCRIPTION = 'Create a new Identity Verification

Official Plaid endpoint: POST /identity_verification/create

Create a new Identity Verification for the user specified by the `client_user_id` and/or `user_id` field. At least one of these two fields must be provided. The requirements and behavior of the verification are determined by the `template_id` provided. If `user_id` is provided, there must be an associated user otherwise an error will be returned. If you don\'t know whether an active Identity Verification exists for a given `client_user_id` and/or `user_id`, you can specify `"is_idempotent": true` in the request body. With idempotency enabled, a new Identity Verification will only be created if one does not already exist for the associated `client_user_id` and/or `user_id`, and `template_id...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity_verification/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}