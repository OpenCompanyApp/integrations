<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Generate Exchange Rate Quote.
 *
 * Executes the official Braintree GraphQL field generateExchangeRateQuote.
 */
class BraintreeGenerateExchangeRateQuote extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_generate_exchange_rate_quote';
}
