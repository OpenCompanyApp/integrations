<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Add a feature flag target.
 *
 * Maps to the official WorkOS endpoint post /feature-flags/{slug}/targets/{resourceId}.
 */
class WorkOSFlagTargetsCreateTarget extends AbstractWorkOSTool
{
    protected const NAME = 'workos_flag_targets_create_target';
    protected const DESCRIPTION = 'Add a feature flag target

Official WorkOS endpoint: POST /feature-flags/{slug}/targets/{resourceId}

Enables a feature flag for a specific target in the current environment. Currently, supported targets include users and organizations.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/feature-flags/{slug}/targets/{resourceId}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
  'resourceId' => 'resource_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
