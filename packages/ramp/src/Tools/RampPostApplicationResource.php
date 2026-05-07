<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a financing application.
 *
 * Maps to the official Ramp endpoint post /developer/v1/applications.
 */
class RampPostApplicationResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_application_resource';
    protected const DESCRIPTION = 'Create a financing application

Official Ramp endpoint: POST /developer/v1/applications

This endpoint will create a new business for the applicant and email them with instructions to sign up and continue the application. If the applicant email already exists in Ramp, an invitation email will be re-sent if the business is still in the application stage. If the business is already approved, this operation will be a no-op. Note this endpoint returns success regardless of whether the email exists in Ramp.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/applications';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
