<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Role Assignments Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}.
 */
class GoogleWorkspaceAdminRoleAssignmentsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_role_assignments_delete';
    protected const DESCRIPTION = 'Role Assignments Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customer}/roleassignments/{roleAssignmentId}
Deletes a role assignment.';
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
    protected const METHOD = 'DELETE';
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