<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get encrypted bank details.
 *
 * Maps to the official GoCardless endpoint GET /bank_account_details/{customer_bank_account_id}.
 */
class GoCardlessGetBankAccountDetails extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_bank_account_details';
    protected const DESCRIPTION = 'Returns bank account details in the flattened JSON Web Encryption format described in RFC 7516. You must specify a `Gc-Key-Id` header when using this endpoint. See [Public Key Setup](https://developer.gocardless.com/gc-embed/bank-details-access#public_key_setup) for more details.

Official GoCardless endpoint: GET /bank_account_details/{customer_bank_account_id}.';
    protected const PARAMETERS = [
        'customer_bank_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer bank account id',
        ],
        'gc_key_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Public key identifier sent as the Gc-Key-Id header for encrypted bank account details.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/bank_account_details/{customer_bank_account_id}';
    protected const PATH_PARAMS = [
        'customer_bank_account_id' => 'customer_bank_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Gc-Key-Id' => 'gc_key_id',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
