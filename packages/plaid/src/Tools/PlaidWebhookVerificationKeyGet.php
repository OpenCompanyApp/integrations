<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get webhook verification key.
 *
 * Maps to the official Plaid endpoint post /webhook_verification_key/get.
 */
class PlaidWebhookVerificationKeyGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_webhook_verification_key_get';
    protected const DESCRIPTION = 'Get webhook verification key

Official Plaid endpoint: POST /webhook_verification_key/get

Plaid signs all outgoing webhooks and provides JSON Web Tokens (JWTs) so that you can verify the authenticity of any incoming webhooks to your application. A message signature is included in the `Plaid-Verification` header. The `/webhook_verification_key/get` endpoint provides a JSON Web Key (JWK) that can be used to verify a JWT.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/webhook_verification_key/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}