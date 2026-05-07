<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Direct Debit LBA > Funding limits.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/account_capabilities/funding_limits.
 */
class AirwallexTreasuryFundingLimits extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_funding_limits';
    protected const DESCRIPTION = 'Treasury > Direct Debit LBA > Funding limits.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/account_capabilities/funding_limits.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/account_capabilities/funding_limits';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
