<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update JWT template.
 *
 * Maps to the official WorkOS endpoint put /user_management/jwt_template.
 */
class WorkOSJwtTemplatesUpdateJwtTemplate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_jwt_templates_update_jwt_template';
    protected const DESCRIPTION = 'Update JWT template

Official WorkOS endpoint: PUT /user_management/jwt_template

Update the JWT template for the current environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/user_management/jwt_template';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
