<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a Bank Authorisation.
 *
 * Maps to the official GoCardless endpoint GET /bank_authorisations/{bank_authorisation_id}.
 */
class GoCardlessGetBankAuthorisations extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_bank_authorisations';
    protected const DESCRIPTION = 'Get a single bank authorisation.

Official GoCardless endpoint: GET /bank_authorisations/{bank_authorisation_id}.';
    protected const PARAMETERS = [
        'bank_authorisation_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The bank authorisation id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/bank_authorisations/{bank_authorisation_id}';
    protected const PATH_PARAMS = [
        'bank_authorisation_id' => 'bank_authorisation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
