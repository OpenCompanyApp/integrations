<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Role Assignments Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}.
 */
class GoogleWorkspaceAdminRoleAssignmentsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_role_assignments_get';
    protected const DESCRIPTION = 'Role Assignments Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}
Retrieves a role assignment.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'roleAssignmentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `roleAssignmentId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'roleAssignmentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}