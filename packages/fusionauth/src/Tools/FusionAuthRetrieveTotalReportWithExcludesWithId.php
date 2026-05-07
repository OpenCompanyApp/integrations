<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Total Report With Excludes With Id.
 *
 * Maps to GET /api/report/totals in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveTotalReportWithExcludesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_total_report_with_excludes_with_id',
  'class' => 'FusionAuthRetrieveTotalReportWithExcludesWithId',
  'method' => 'GET',
  'path' => '/api/report/totals',
  'operation_id' => 'retrieveTotalReportWithExcludesWithId',
  'summary' => 'retrieve Total Report With Excludes With Id',
  'description' => 'Retrieves the totals report. This allows excluding applicationTotals from the report. An empty list will include the applicationTotals.',
  'parameters' =>
  array (
    'excludes' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'List of fields to exclude in the response. Currently only allows applicationTotals.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'excludes' => 'excludes',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
