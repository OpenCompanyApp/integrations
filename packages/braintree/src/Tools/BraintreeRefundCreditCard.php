<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Refund Credit Card.
 *
 * Executes the official Braintree GraphQL field refundCreditCard.
 */
class BraintreeRefundCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_refund_credit_card';
}
