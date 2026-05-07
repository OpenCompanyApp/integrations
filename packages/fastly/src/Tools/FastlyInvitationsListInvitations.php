<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List invitations
 *
 * Maps to Fastly generated client operation InvitationsApi::listInvitations (GET /invitations).
 */
class FastlyInvitationsListInvitations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_invitations_list_invitations';
    protected const DESCRIPTION = 'List invitations

Official Fastly client operation: InvitationsApi::listInvitations
Endpoint: GET /invitations

List invitations';
    protected const PARAMETERS = array (
  'page_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_number`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_size`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_invitations_list_invitations',
  'class' => 'FastlyInvitationsListInvitations',
  'api_class' => 'InvitationsApi',
  'method_name' => 'listInvitations',
  'method' => 'GET',
  'path' => '/invitations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List invitations',
  'description' => 'List invitations',
  'type' => 'read',
  'parameters' =>
  array (
    'page_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_number`.',
    ),
    'page_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_size`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
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
