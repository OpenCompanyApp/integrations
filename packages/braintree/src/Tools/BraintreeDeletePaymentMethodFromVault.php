<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete Payment Method From Vault.
 *
 * Executes the official Braintree GraphQL field deletePaymentMethodFromVault.
 */
class BraintreeDeletePaymentMethodFromVault extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_payment_method_from_vault';
}
