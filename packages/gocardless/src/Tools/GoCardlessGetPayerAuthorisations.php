<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single Payer Authorisation.
 *
 * Maps to the official GoCardless endpoint GET /payer_authorisations/{payer_authorisation_id}.
 */
class GoCardlessGetPayerAuthorisations extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_payer_authorisations';
    protected const DESCRIPTION = 'Retrieves the details of a single existing Payer Authorisation. It can be used for polling the status of a Payer Authorisation. **Deprecated:** Payer Authorisation is legacy API and cannot be used by new integrators. The [Billing Request](#billing-requests) API should be used for any new integrations.

Official GoCardless endpoint: GET /payer_authorisations/{payer_authorisation_id}.';
    protected const PARAMETERS = [
        'payer_authorisation_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payer authorisation id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payer_authorisations/{payer_authorisation_id}';
    protected const PATH_PARAMS = [
        'payer_authorisation_id' => 'payer_authorisation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
