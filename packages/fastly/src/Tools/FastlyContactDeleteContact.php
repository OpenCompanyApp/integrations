<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a contact
 *
 * Maps to Fastly generated client operation ContactApi::deleteContact (DELETE /customer/{customer_id}/contacts/{contact_id}).
 */
class FastlyContactDeleteContact extends AbstractFastlyTool
{
    protected const NAME = 'fastly_contact_delete_contact';
    protected const DESCRIPTION = 'Delete a contact

Official Fastly client operation: ContactApi::deleteContact
Endpoint: DELETE /customer/{customer_id}/contacts/{contact_id}

Delete a contact';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
  'contact_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `contact_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_contact_delete_contact',
  'class' => 'FastlyContactDeleteContact',
  'api_class' => 'ContactApi',
  'method_name' => 'deleteContact',
  'method' => 'DELETE',
  'path' => '/customer/{customer_id}/contacts/{contact_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a contact',
  'description' => 'Delete a contact',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
    'contact_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `contact_id`.',
    ),
  ),
  'path_params' =>
  array (
    'customer_id' => 'customer_id',
    'contact_id' => 'contact_id',
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
