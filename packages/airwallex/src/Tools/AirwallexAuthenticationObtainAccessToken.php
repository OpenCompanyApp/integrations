<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Authentication > API Access > Obtain access token.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/authentication/login.
 */
class AirwallexAuthenticationObtainAccessToken extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_authentication_obtain_access_token';
    protected const DESCRIPTION = 'Authentication > API Access > Obtain access token.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/authentication/login.';
    protected const PARAMETERS = [];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/authentication/login';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'api_key';
}
