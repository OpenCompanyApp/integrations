<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Vault Credit Card.
 *
 * Executes the official Braintree GraphQL field vaultCreditCard.
 */
class BraintreeVaultCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_vault_credit_card';
}
