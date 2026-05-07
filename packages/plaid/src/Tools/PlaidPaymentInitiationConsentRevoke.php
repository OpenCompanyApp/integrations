<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Revoke payment consent.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/consent/revoke.
 */
class PlaidPaymentInitiationConsentRevoke extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_consent_revoke';
    protected const DESCRIPTION = 'Revoke payment consent

Official Plaid endpoint: POST /payment_initiation/consent/revoke

The `/payment_initiation/consent/revoke` endpoint can be used to revoke the payment consent. Once the consent is revoked, it is not possible to initiate payments using it.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/consent/revoke';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}