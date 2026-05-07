<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Supporting Services > Reference Data > Industry categories.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/reference/industry_categories.
 */
class AirwallexSupportingServicesIndustryCategories extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_supporting_services_industry_categories';
    protected const DESCRIPTION = 'Supporting Services > Reference Data > Industry categories.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/reference/industry_categories.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/reference/industry_categories';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
