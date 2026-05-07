<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Vault Payment Method.
 *
 * Executes the official Braintree GraphQL field vaultPaymentMethod.
 */
class BraintreeVaultPaymentMethod extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_vault_payment_method';
}
