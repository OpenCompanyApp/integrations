<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Report Login.
 *
 * Maps to GET /api/report/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveReportLogin extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_report_login',
  'class' => 'FusionAuthRetrieveReportLogin',
  'method' => 'GET',
  'path' => '/api/report/login',
  'operation_id' => 'retrieveReportLogin',
  'summary' => 'retrieve Report Login',
  'description' => 'Retrieves the login report between the two instants for a particular user by login Id, using specific loginIdTypes. If you specify an application id, it will only return the login counts for that application. OR Retrieves the login report between the two instants for a particular user by login Id. If you specify an application Id, it will only return the login counts for that application. OR Retrieves the login report between the two instants for a particular user by Id. If you specify an applic',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The application id.',
    ),
    'login_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The userId id.',
    ),
    'start' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The start instant as UTC milliseconds since Epoch.',
    ),
    'end' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The end instant as UTC milliseconds since Epoch.',
    ),
    'login_id_types' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'The identity types that FusionAuth will compare the loginId to.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The userId Id.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'applicationId' => 'application_id',
    'loginId' => 'login_id',
    'start' => 'start',
    'end' => 'end',
    'loginIdTypes' => 'login_id_types',
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
