<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get payment consent.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/consent/get.
 */
class PlaidPaymentInitiationConsentGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_consent_get';
    protected const DESCRIPTION = 'Get payment consent

Official Plaid endpoint: POST /payment_initiation/consent/get

The `/payment_initiation/consent/get` endpoint can be used to check the status of a payment consent, as well as to receive basic information such as recipient and constraints.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/consent/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}