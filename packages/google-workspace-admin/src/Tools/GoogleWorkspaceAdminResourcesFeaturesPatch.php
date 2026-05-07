<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Features Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/customer/{customer}/resources/features/{featureKey}.
 */
class GoogleWorkspaceAdminResourcesFeaturesPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_features_patch';
    protected const DESCRIPTION = 'Resources Features Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/customer/{customer}/resources/features/{featureKey}
Patches a feature.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'featureKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `featureKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Feature` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/features/{featureKey}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'featureKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}