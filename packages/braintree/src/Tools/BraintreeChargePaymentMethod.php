<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge Payment Method.
 *
 * Executes the official Braintree GraphQL field chargePaymentMethod.
 */
class BraintreeChargePaymentMethod extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_payment_method';
}
