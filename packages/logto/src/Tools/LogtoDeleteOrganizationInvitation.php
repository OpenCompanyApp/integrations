<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete organization invitation.
 *
 * Maps to DELETE /api/organization-invitations/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationInvitation extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_invitation',
  'class' => 'LogtoDeleteOrganizationInvitation',
  'method' => 'DELETE',
  'path' => '/api/organization-invitations/{id}',
  'operation_id' => 'DeleteOrganizationInvitation',
  'summary' => 'Delete organization invitation',
  'description' => 'Delete an organization invitation by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization invitation.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
