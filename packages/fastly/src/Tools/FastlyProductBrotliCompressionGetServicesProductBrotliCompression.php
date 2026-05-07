<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductBrotliCompressionApi::getServicesProductBrotliCompression (GET /enabled-products/v1/brotli_compression/services).
 */
class FastlyProductBrotliCompressionGetServicesProductBrotliCompression extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_brotli_compression_get_services_product_brotli_compression';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductBrotliCompressionApi::getServicesProductBrotliCompression
Endpoint: GET /enabled-products/v1/brotli_compression/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_brotli_compression_get_services_product_brotli_compression',
  'class' => 'FastlyProductBrotliCompressionGetServicesProductBrotliCompression',
  'api_class' => 'ProductBrotliCompressionApi',
  'method_name' => 'getServicesProductBrotliCompression',
  'method' => 'GET',
  'path' => '/enabled-products/v1/brotli_compression/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get services with product enabled',
  'description' => 'Get services with product enabled',
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
