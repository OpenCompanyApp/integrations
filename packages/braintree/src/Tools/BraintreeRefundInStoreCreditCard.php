<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Refund In Store Credit Card.
 *
 * Executes the official Braintree GraphQL field refundInStoreCreditCard.
 */
class BraintreeRefundInStoreCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_refund_in_store_credit_card';
}
