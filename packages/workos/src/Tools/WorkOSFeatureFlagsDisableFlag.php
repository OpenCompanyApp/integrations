<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Disable a feature flag.
 *
 * Maps to the official WorkOS endpoint put /feature-flags/{slug}/disable.
 */
class WorkOSFeatureFlagsDisableFlag extends AbstractWorkOSTool
{
    protected const NAME = 'workos_feature_flags_disable_flag';
    protected const DESCRIPTION = 'Disable a feature flag

Official WorkOS endpoint: PUT /feature-flags/{slug}/disable

Disables a feature flag in the current environment.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/feature-flags/{slug}/disable';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
