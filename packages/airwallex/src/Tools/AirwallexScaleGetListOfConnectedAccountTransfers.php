<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Connected Account Transfers > Get list of connected account transfers.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/connected_account_transfers.
 */
class AirwallexScaleGetListOfConnectedAccountTransfers extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_get_list_of_connected_account_transfers';
    protected const DESCRIPTION = 'Scale > Connected Account Transfers > Get list of connected account transfers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/connected_account_transfers.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/connected_account_transfers';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
