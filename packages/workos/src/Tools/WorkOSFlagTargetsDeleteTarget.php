<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove a feature flag target.
 *
 * Maps to the official WorkOS endpoint delete /feature-flags/{slug}/targets/{resourceId}.
 */
class WorkOSFlagTargetsDeleteTarget extends AbstractWorkOSTool
{
    protected const NAME = 'workos_flag_targets_delete_target';
    protected const DESCRIPTION = 'Remove a feature flag target

Official WorkOS endpoint: DELETE /feature-flags/{slug}/targets/{resourceId}

Removes a target from the feature flag\'s target list in the current environment. Currently, supported targets include users and organizations.';
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
);
    protected const METHOD = 'delete';
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
