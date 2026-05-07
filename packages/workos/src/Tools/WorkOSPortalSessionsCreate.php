<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Generate a Portal Link.
 *
 * Maps to the official WorkOS endpoint post /portal/generate_link.
 */
class WorkOSPortalSessionsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_portal_sessions_create';
    protected const DESCRIPTION = 'Generate a Portal Link

Official WorkOS endpoint: POST /portal/generate_link

Generate a Portal Link scoped to an Organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/portal/generate_link';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
