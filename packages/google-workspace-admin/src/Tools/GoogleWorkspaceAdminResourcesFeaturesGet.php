<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Features Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/resources/features/{featureKey}.
 */
class GoogleWorkspaceAdminResourcesFeaturesGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_features_get';
    protected const DESCRIPTION = 'Resources Features Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/resources/features/{featureKey}
Retrieves a feature.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/features/{featureKey}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'featureKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}