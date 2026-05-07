<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an invitation
 *
 * Maps to Fastly generated client operation InvitationsApi::deleteInvitation (DELETE /invitations/{invitation_id}).
 */
class FastlyInvitationsDeleteInvitation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_invitations_delete_invitation';
    protected const DESCRIPTION = 'Delete an invitation

Official Fastly client operation: InvitationsApi::deleteInvitation
Endpoint: DELETE /invitations/{invitation_id}

Delete an invitation';
    protected const PARAMETERS = array (
  'invitation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `invitation_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_invitations_delete_invitation',
  'class' => 'FastlyInvitationsDeleteInvitation',
  'api_class' => 'InvitationsApi',
  'method_name' => 'deleteInvitation',
  'method' => 'DELETE',
  'path' => '/invitations/{invitation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an invitation',
  'description' => 'Delete an invitation',
  'type' => 'write',
  'parameters' =>
  array (
    'invitation_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `invitation_id`.',
    ),
  ),
  'path_params' =>
  array (
    'invitation_id' => 'invitation_id',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
