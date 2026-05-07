<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge Pay Pal Account.
 *
 * Executes the official Braintree GraphQL field chargePayPalAccount.
 */
class BraintreeChargePayPalAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_pay_pal_account';
}
