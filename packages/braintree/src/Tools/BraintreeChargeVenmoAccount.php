<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge Venmo Account.
 *
 * Executes the official Braintree GraphQL field chargeVenmoAccount.
 */
class BraintreeChargeVenmoAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_venmo_account';
}
