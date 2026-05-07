<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Execute a single payment using consent.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/consent/payment/execute.
 */
class PlaidPaymentInitiationConsentPaymentExecute extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_consent_payment_execute';
    protected const DESCRIPTION = 'Execute a single payment using consent

Official Plaid endpoint: POST /payment_initiation/consent/payment/execute

The `/payment_initiation/consent/payment/execute` endpoint can be used to execute payments using payment consent.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/consent/payment/execute';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}