<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create organization invitation.
 *
 * Maps to POST /api/organization-invitations in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationInvitation extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_invitation',
  'class' => 'LogtoCreateOrganizationInvitation',
  'method' => 'POST',
  'path' => '/api/organization-invitations',
  'operation_id' => 'CreateOrganizationInvitation',
  'summary' => 'Create organization invitation',
  'description' => 'Create an organization invitation and optionally send it via email. The tenant should have an email connector configured if you want to send the invitation via email at this point.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
