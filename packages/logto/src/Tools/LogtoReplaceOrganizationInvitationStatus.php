<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update organization invitation status.
 *
 * Maps to PUT /api/organization-invitations/{id}/status in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationInvitationStatus extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_invitation_status',
  'class' => 'LogtoReplaceOrganizationInvitationStatus',
  'method' => 'PUT',
  'path' => '/api/organization-invitations/{id}/status',
  'operation_id' => 'ReplaceOrganizationInvitationStatus',
  'summary' => 'Update organization invitation status',
  'description' => 'Update the status of an organization invitation by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization invitation.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
