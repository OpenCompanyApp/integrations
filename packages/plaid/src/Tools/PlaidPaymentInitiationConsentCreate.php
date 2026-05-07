<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create payment consent.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/consent/create.
 */
class PlaidPaymentInitiationConsentCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_consent_create';
    protected const DESCRIPTION = 'Create payment consent

Official Plaid endpoint: POST /payment_initiation/consent/create

The `/payment_initiation/consent/create` endpoint is used to create a payment consent, which can be used to initiate payments on behalf of the user. Payment consents are created with `UNAUTHORISED` status by default and must be authorised by the user before payments can be initiated. Consents can be limited in time and scope, and have constraints that describe limitations for payments.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/consent/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}