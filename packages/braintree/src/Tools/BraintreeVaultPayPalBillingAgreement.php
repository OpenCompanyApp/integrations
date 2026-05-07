<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Vault Pay Pal Billing Agreement.
 *
 * Executes the official Braintree GraphQL field vaultPayPalBillingAgreement.
 */
class BraintreeVaultPayPalBillingAgreement extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_vault_pay_pal_billing_agreement';
}
