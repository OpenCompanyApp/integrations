<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a customer
 *
 * Maps to Fastly generated client operation CustomerApi::updateCustomer (PUT /customer/{customer_id}).
 */
class FastlyCustomerUpdateCustomer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_update_customer';
    protected const DESCRIPTION = 'Update a customer

Official Fastly client operation: CustomerApi::updateCustomer
Endpoint: PUT /customer/{customer_id}

Update a customer';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
  'billing_contact_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billing_contact_id`.',
  ),
  'billing_network_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billing_network_type`.',
  ),
  'billing_ref' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billing_ref`.',
  ),
  'can_configure_wordpress' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `can_configure_wordpress`.',
  ),
  'can_reset_passwords' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `can_reset_passwords`.',
  ),
  'can_upload_vcl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `can_upload_vcl`.',
  ),
  'force_2fa' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force_2fa`.',
  ),
  'force_sso' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force_sso`.',
  ),
  'has_account_panel' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_account_panel`.',
  ),
  'has_improved_events' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_improved_events`.',
  ),
  'has_improved_ssl_config' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_improved_ssl_config`.',
  ),
  'has_openstack_logging' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_openstack_logging`.',
  ),
  'has_pci' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_pci`.',
  ),
  'has_pci_passwords' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `has_pci_passwords`.',
  ),
  'ip_whitelist' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ip_whitelist`.',
  ),
  'legal_contact_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `legal_contact_id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'owner_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `owner_id`.',
  ),
  'phone_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `phone_number`.',
  ),
  'postal_address' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `postal_address`.',
  ),
  'pricing_plan' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `pricing_plan`.',
  ),
  'pricing_plan_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `pricing_plan_id`.',
  ),
  'security_contact_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `security_contact_id`.',
  ),
  'technical_contact_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `technical_contact_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_update_customer',
  'class' => 'FastlyCustomerUpdateCustomer',
  'api_class' => 'CustomerApi',
  'method_name' => 'updateCustomer',
  'method' => 'PUT',
  'path' => '/customer/{customer_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a customer',
  'description' => 'Update a customer',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
    'billing_contact_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billing_contact_id`.',
    ),
    'billing_network_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billing_network_type`.',
    ),
    'billing_ref' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billing_ref`.',
    ),
    'can_configure_wordpress' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `can_configure_wordpress`.',
    ),
    'can_reset_passwords' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `can_reset_passwords`.',
    ),
    'can_upload_vcl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `can_upload_vcl`.',
    ),
    'force_2fa' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force_2fa`.',
    ),
    'force_sso' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force_sso`.',
    ),
    'has_account_panel' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_account_panel`.',
    ),
    'has_improved_events' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_improved_events`.',
    ),
    'has_improved_ssl_config' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_improved_ssl_config`.',
    ),
    'has_openstack_logging' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_openstack_logging`.',
    ),
    'has_pci' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_pci`.',
    ),
    'has_pci_passwords' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `has_pci_passwords`.',
    ),
    'ip_whitelist' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ip_whitelist`.',
    ),
    'legal_contact_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `legal_contact_id`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'owner_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `owner_id`.',
    ),
    'phone_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `phone_number`.',
    ),
    'postal_address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `postal_address`.',
    ),
    'pricing_plan' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `pricing_plan`.',
    ),
    'pricing_plan_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `pricing_plan_id`.',
    ),
    'security_contact_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `security_contact_id`.',
    ),
    'technical_contact_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `technical_contact_id`.',
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
    'billing_contact_id' => 'billing_contact_id',
    'billing_network_type' => 'billing_network_type',
    'billing_ref' => 'billing_ref',
    'can_configure_wordpress' => 'can_configure_wordpress',
    'can_reset_passwords' => 'can_reset_passwords',
    'can_upload_vcl' => 'can_upload_vcl',
    'force_2fa' => 'force_2fa',
    'force_sso' => 'force_sso',
    'has_account_panel' => 'has_account_panel',
    'has_improved_events' => 'has_improved_events',
    'has_improved_ssl_config' => 'has_improved_ssl_config',
    'has_openstack_logging' => 'has_openstack_logging',
    'has_pci' => 'has_pci',
    'has_pci_passwords' => 'has_pci_passwords',
    'ip_whitelist' => 'ip_whitelist',
    'legal_contact_id' => 'legal_contact_id',
    'name' => 'name',
    'owner_id' => 'owner_id',
    'phone_number' => 'phone_number',
    'postal_address' => 'postal_address',
    'pricing_plan' => 'pricing_plan',
    'pricing_plan_id' => 'pricing_plan_id',
    'security_contact_id' => 'security_contact_id',
    'technical_contact_id' => 'technical_contact_id',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
