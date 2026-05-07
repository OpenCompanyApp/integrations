<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Registration Report With Id.
 *
 * Maps to GET /api/report/registration in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveRegistrationReportWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_registration_report_with_id',
  'class' => 'FusionAuthRetrieveRegistrationReportWithId',
  'method' => 'GET',
  'path' => '/api/report/registration',
  'operation_id' => 'retrieveRegistrationReportWithId',
  'summary' => 'retrieve Registration Report With Id',
  'description' => 'Retrieves the registration report between the two instants. If you specify an application Id, it will only return the registration counts for that application.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The application Id.',
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
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'applicationId' => 'application_id',
    'start' => 'start',
    'end' => 'end',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
