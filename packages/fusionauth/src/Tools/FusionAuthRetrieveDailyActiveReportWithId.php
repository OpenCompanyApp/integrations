<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Daily Active Report With Id.
 *
 * Maps to GET /api/report/daily-active-user in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveDailyActiveReportWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_daily_active_report_with_id',
  'class' => 'FusionAuthRetrieveDailyActiveReportWithId',
  'method' => 'GET',
  'path' => '/api/report/daily-active-user',
  'operation_id' => 'retrieveDailyActiveReportWithId',
  'summary' => 'retrieve Daily Active Report With Id',
  'description' => 'Retrieves the daily active user report between the two instants. If you specify an application Id, it will only return the daily active counts for that application.',
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
