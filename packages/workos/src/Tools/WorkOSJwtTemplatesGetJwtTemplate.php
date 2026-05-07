<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get JWT template.
 *
 * Maps to the official WorkOS endpoint get /user_management/jwt_template.
 */
class WorkOSJwtTemplatesGetJwtTemplate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_jwt_templates_get_jwt_template';
    protected const DESCRIPTION = 'Get JWT template

Official WorkOS endpoint: GET /user_management/jwt_template

Get the JWT template for the current environment.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/jwt_template';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
