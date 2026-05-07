<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get company.
 *
 * Maps to the official Brex endpoint get /v2/company.
 */
class BrexTeamGetCompany extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_company';
    protected const DESCRIPTION = 'Get company

Official Brex endpoint: GET /v2/company

This endpoint returns the company associated with the OAuth2 access token.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/company';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
