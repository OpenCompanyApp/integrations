<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a feature flag.
 *
 * Maps to the official WorkOS endpoint get /feature-flags/{slug}.
 */
class WorkOSFeatureFlagsFindBySlug extends AbstractWorkOSTool
{
    protected const NAME = 'workos_feature_flags_find_by_slug';
    protected const DESCRIPTION = 'Get a feature flag

Official WorkOS endpoint: GET /feature-flags/{slug}

Get the details of an existing feature flag by its slug.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/feature-flags/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
