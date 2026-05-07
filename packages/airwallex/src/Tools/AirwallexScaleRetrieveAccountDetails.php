<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Accounts > Retrieve account details.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/account.
 */
class AirwallexScaleRetrieveAccountDetails extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_retrieve_account_details';
    protected const DESCRIPTION = 'Scale > Accounts > Retrieve account details.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/account.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/account';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
