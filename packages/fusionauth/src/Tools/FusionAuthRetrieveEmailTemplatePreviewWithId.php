<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Email Template Preview With Id.
 *
 * Maps to POST /api/email/template/preview in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEmailTemplatePreviewWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_email_template_preview_with_id',
  'class' => 'FusionAuthRetrieveEmailTemplatePreviewWithId',
  'method' => 'POST',
  'path' => '/api/email/template/preview',
  'operation_id' => 'retrieveEmailTemplatePreviewWithId',
  'summary' => 'retrieve Email Template Preview With Id',
  'description' => 'Creates a preview of the email template provided in the request. This allows you to preview an email template that hasn\'t been saved to the database yet. The entire email template does not need to be provided on the request. This will create the preview based on whatever is given.',
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
