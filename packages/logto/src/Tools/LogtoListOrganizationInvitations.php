<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization invitations.
 *
 * Maps to GET /api/organization-invitations in the official Logto OpenAPI source.
 */
class LogtoListOrganizationInvitations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_invitations',
  'class' => 'LogtoListOrganizationInvitations',
  'method' => 'GET',
  'path' => '/api/organization-invitations',
  'operation_id' => 'ListOrganizationInvitations',
  'summary' => 'Get organization invitations',
  'description' => 'Get organization invitations.',
  'parameters' =>
  array (
    'organization_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `organizationId`.',
    ),
    'inviter_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `inviterId`.',
    ),
    'invitee' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `invitee`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'organizationId' => 'organization_id',
    'inviterId' => 'inviter_id',
    'invitee' => 'invitee',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
