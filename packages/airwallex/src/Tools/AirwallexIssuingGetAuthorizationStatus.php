<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Authorizations > Get authorization status.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/issuing/authorizations.
 */
class AirwallexIssuingGetAuthorizationStatus extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_get_authorization_status';
    protected const DESCRIPTION = 'Issuing > Authorizations > Get authorization status.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/authorizations.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/issuing/authorizations';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
