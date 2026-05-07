<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Orgunits List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/orgunits.
 */
class GoogleWorkspaceAdminOrgunitsList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_orgunits_list';
    protected const DESCRIPTION = 'Orgunits List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/orgunits
Retrieves a list of all organizational units for an account.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: type, orgUnitPath.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `type`.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'children',
      2 => 'allIncludingParent',
    ),
  ),
  'orgUnitPath' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitPath`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/orgunits';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'type',
  1 => 'orgUnitPath',
);
    protected const BODY_REQUIRED = false;
}