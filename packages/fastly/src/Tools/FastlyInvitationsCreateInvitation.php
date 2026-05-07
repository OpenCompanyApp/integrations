<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an invitation
 *
 * Maps to Fastly generated client operation InvitationsApi::createInvitation (POST /invitations).
 */
class FastlyInvitationsCreateInvitation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_invitations_create_invitation';
    protected const DESCRIPTION = 'Create an invitation

Official Fastly client operation: InvitationsApi::createInvitation
Endpoint: POST /invitations

Create an invitation';
    protected const PARAMETERS = array (
  'invitation' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `invitation`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_invitations_create_invitation',
  'class' => 'FastlyInvitationsCreateInvitation',
  'api_class' => 'InvitationsApi',
  'method_name' => 'createInvitation',
  'method' => 'POST',
  'path' => '/invitations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an invitation',
  'description' => 'Create an invitation',
  'type' => 'write',
  'parameters' =>
  array (
    'invitation' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `invitation`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'form_params' =>
  array (
  ),
  'body_param' => 'invitation',
  'body_required' => false,
);
}
