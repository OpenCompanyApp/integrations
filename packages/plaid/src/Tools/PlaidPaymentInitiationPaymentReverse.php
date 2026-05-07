<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Reverse an existing payment.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/payment/reverse.
 */
class PlaidPaymentInitiationPaymentReverse extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_payment_reverse';
    protected const DESCRIPTION = 'Reverse an existing payment

Official Plaid endpoint: POST /payment_initiation/payment/reverse

Reverse a settled payment from a Plaid virtual account. The original payment must be in a settled state to be refunded. To refund partially, specify the amount as part of the request. If the amount is not specified, the refund amount will be equal to all of the remaining payment amount that has not been refunded yet. The refund will go back to the source account that initiated the payment. The original payment must have been initiated to a Plaid virtual account so that this account can be used to initiate the refund. Providing counterparty information such as date of birth and address increases the likelihood of refund being successful without human intervention.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/payment/reverse';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}