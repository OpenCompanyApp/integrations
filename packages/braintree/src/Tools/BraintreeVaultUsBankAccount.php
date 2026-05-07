<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Vault Us Bank Account.
 *
 * Executes the official Braintree GraphQL field vaultUsBankAccount.
 */
class BraintreeVaultUsBankAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_vault_us_bank_account';
}
