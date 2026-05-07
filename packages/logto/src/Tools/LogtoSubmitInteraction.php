<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Submit interaction.
 *
 * Maps to POST /api/experience/submit in the official Logto OpenAPI source.
 */
class LogtoSubmitInteraction extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_submit_interaction',
  'class' => 'LogtoSubmitInteraction',
  'method' => 'POST',
  'path' => '/api/experience/submit',
  'operation_id' => 'SubmitInteraction',
  'summary' => 'Submit interaction',
  'description' => 'Submit the current interaction. - Submit the verified user identity to the OIDC provider for further authentication (SignIn and Register). - Update the user\'s profile data if any (SignIn and Register). - Reset the password and clear all the interaction records (ForgotPassword).',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
