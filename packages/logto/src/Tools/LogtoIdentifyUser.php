<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Identify user for the current interaction.
 *
 * Maps to POST /api/experience/identification in the official Logto OpenAPI source.
 */
class LogtoIdentifyUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_identify_user',
  'class' => 'LogtoIdentifyUser',
  'method' => 'POST',
  'path' => '/api/experience/identification',
  'operation_id' => 'IdentifyUser',
  'summary' => 'Identify user for the current interaction',
  'description' => 'This API identifies the user based on the verificationId within the current experience interaction: - `SignIn` and `ForgotPassword` interactions: Verifies the user\'s identity using the provided `verificationId`. - `Register` interaction: Creates a new user account using the profile data from the current interaction. If a verificationId is provided, the profile data will first be updated with the verification record before creating the account. If not, the account is created directly from the sto',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
