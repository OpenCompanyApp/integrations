<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Fastly's public IPs
 *
 * Maps to Fastly generated client operation PublicIpListApi::listFastlyIps (GET /public-ip-list).
 */
class FastlyPublicIpListListFastlyIps extends AbstractFastlyTool
{
    protected const NAME = 'fastly_public_ip_list_list_fastly_ips';
    protected const DESCRIPTION = 'List Fastly\'s public IPs

Official Fastly client operation: PublicIpListApi::listFastlyIps
Endpoint: GET /public-ip-list

List Fastly\'s public IPs';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_public_ip_list_list_fastly_ips',
  'class' => 'FastlyPublicIpListListFastlyIps',
  'api_class' => 'PublicIpListApi',
  'method_name' => 'listFastlyIps',
  'method' => 'GET',
  'path' => '/public-ip-list',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Fastly\'s public IPs',
  'description' => 'List Fastly\'s public IPs',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
