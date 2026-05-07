<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a bank account holder verification..
 *
 * Maps to the official GoCardless endpoint GET /bank_account_holder_verifications/{bank_account_holder_verification_id}.
 */
class GoCardlessGetBankAccountHolderVerifications extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_bank_account_holder_verifications';
    protected const DESCRIPTION = 'Fetches a bank account holder verification by ID.

Official GoCardless endpoint: GET /bank_account_holder_verifications/{bank_account_holder_verification_id}.';
    protected const PARAMETERS = [
        'bank_account_holder_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The bank account holder verification id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/bank_account_holder_verifications/{bank_account_holder_verification_id}';
    protected const PATH_PARAMS = [
        'bank_account_holder_verification_id' => 'bank_account_holder_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
