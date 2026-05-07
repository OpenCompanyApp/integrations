<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge In Store Credit Card.
 *
 * Executes the official Braintree GraphQL field chargeInStoreCreditCard.
 */
class BraintreeChargeInStoreCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_in_store_credit_card';
}
