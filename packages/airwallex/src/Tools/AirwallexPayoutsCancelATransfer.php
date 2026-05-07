<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Transfers > Cancel a transfer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/transfers/{transfer_id}/cancel.
 */
class AirwallexPayoutsCancelATransfer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_cancel_a_transfer';
    protected const DESCRIPTION = 'Payouts > Transfers > Cancel a transfer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/transfers/{transfer_id}/cancel.';
    protected const PARAMETERS = [
        'transfer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `transfer_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/transfers/{transfer_id}/cancel';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'transfer_id' => 'transfer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
