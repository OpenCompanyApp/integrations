<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Generate Edit Funding Instrument Url.
 *
 * Executes the official Braintree GraphQL field generateEditFundingInstrumentUrl.
 */
class BraintreeGenerateEditFundingInstrumentUrl extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_generate_edit_funding_instrument_url';
}
