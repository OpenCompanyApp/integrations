<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Charge Credit Card.
 *
 * Executes the official Braintree GraphQL field chargeCreditCard.
 */
class BraintreeChargeCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_charge_credit_card';
}
