<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Add a new customer contact
 *
 * Maps to Fastly generated client operation ContactApi::createContacts (POST /customer/{customer_id}/contacts).
 */
class FastlyContactCreateContacts extends AbstractFastlyTool
{
    protected const NAME = 'fastly_contact_create_contacts';
    protected const DESCRIPTION = 'Add a new customer contact

Official Fastly client operation: ContactApi::createContacts
Endpoint: POST /customer/{customer_id}/contacts

Add a new customer contact';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user_id`.',
  ),
  'contact_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `contact_type`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `email`.',
  ),
  'phone' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `phone`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_contact_create_contacts',
  'class' => 'FastlyContactCreateContacts',
  'api_class' => 'ContactApi',
  'method_name' => 'createContacts',
  'method' => 'POST',
  'path' => '/customer/{customer_id}/contacts',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Add a new customer contact',
  'description' => 'Add a new customer contact',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user_id`.',
    ),
    'contact_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `contact_type`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `email`.',
    ),
    'phone' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `phone`.',
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
    'user_id' => 'user_id',
    'contact_type' => 'contact_type',
    'name' => 'name',
    'email' => 'email',
    'phone' => 'phone',
    'customer_id' => 'customer_id',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
