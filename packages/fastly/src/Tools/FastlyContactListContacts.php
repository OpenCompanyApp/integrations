<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List contacts
 *
 * Maps to Fastly generated client operation ContactApi::listContacts (GET /customer/{customer_id}/contacts).
 */
class FastlyContactListContacts extends AbstractFastlyTool
{
    protected const NAME = 'fastly_contact_list_contacts';
    protected const DESCRIPTION = 'List contacts

Official Fastly client operation: ContactApi::listContacts
Endpoint: GET /customer/{customer_id}/contacts

List contacts';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_contact_list_contacts',
  'class' => 'FastlyContactListContacts',
  'api_class' => 'ContactApi',
  'method_name' => 'listContacts',
  'method' => 'GET',
  'path' => '/customer/{customer_id}/contacts',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List contacts',
  'description' => 'List contacts',
  'type' => 'read',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
  ),
  'path_params' =>
  array (
    'customer_id' => 'customer_id',
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
