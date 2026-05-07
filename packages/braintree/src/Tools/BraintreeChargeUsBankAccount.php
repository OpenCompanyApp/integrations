<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge Us Bank Account.
 *
 * Executes the official Braintree GraphQL field chargeUsBankAccount.
 */
class BraintreeChargeUsBankAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_us_bank_account';
}
