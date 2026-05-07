<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Email Templates With Id.
 *
 * Maps to POST /api/email/template/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEmailTemplatesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_email_templates_with_id',
  'class' => 'FusionAuthSearchEmailTemplatesWithId',
  'method' => 'POST',
  'path' => '/api/email/template/search',
  'operation_id' => 'searchEmailTemplatesWithId',
  'summary' => 'search Email Templates With Id',
  'description' => 'Searches email templates with the specified criteria and pagination.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
