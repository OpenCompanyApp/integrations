<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete Factor.
 *
 * Maps to the official WorkOS endpoint delete /auth/factors/{id}.
 */
class WorkOSAuthenticationFactorsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authentication_factors_delete';
    protected const DESCRIPTION = 'Delete Factor

Official WorkOS endpoint: DELETE /auth/factors/{id}

Permanently deletes an Authentication Factor. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/auth/factors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
