<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Bulk delete sentinel activities.
 *
 * Maps to POST /api/sentinel-activities/delete in the official Logto OpenAPI source.
 */
class LogtoDeleteSentinelActivities extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_sentinel_activities',
  'class' => 'LogtoDeleteSentinelActivities',
  'method' => 'POST',
  'path' => '/api/sentinel-activities/delete',
  'operation_id' => 'DeleteSentinelActivities',
  'summary' => 'Bulk delete sentinel activities',
  'description' => 'Remove sentinel activity reports based on the provided target value(identifier).Use this endpoint to unblock users who may be locked out due to too many failed authentication attempts.',
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
