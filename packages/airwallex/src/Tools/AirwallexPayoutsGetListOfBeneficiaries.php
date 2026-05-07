<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Payouts > Beneficiaries > Get list of beneficiaries.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/beneficiaries.
 */
class AirwallexPayoutsGetListOfBeneficiaries extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_payouts_get_list_of_beneficiaries';
    protected const DESCRIPTION = 'Payouts > Beneficiaries > Get list of beneficiaries.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/beneficiaries.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/beneficiaries';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
