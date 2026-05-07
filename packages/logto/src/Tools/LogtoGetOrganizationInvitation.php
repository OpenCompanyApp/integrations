<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization invitation.
 *
 * Maps to GET /api/organization-invitations/{id} in the official Logto OpenAPI source.
 */
class LogtoGetOrganizationInvitation extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_organization_invitation',
  'class' => 'LogtoGetOrganizationInvitation',
  'method' => 'GET',
  'path' => '/api/organization-invitations/{id}',
  'operation_id' => 'GetOrganizationInvitation',
  'summary' => 'Get organization invitation',
  'description' => 'Get an organization invitation by ID.',
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
  'type' => 'read',
);
}
