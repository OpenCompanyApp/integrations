<?php

namespace OpenCompany\Integrations\GoogleDriveActivity\Tools;

/**
 * Activity Query.
 *
 * Maps to the official Google Drive Activity endpoint POST /v2/activity:query.
 */
class GoogleDriveActivityActivityQuery extends AbstractGoogleDriveActivityTool
{
    protected const NAME = 'google_drive_activity_activity_query';
    protected const DESCRIPTION = 'Activity Query

Official Google Drive Activity endpoint: POST /v2/activity:query
Query past activity in Google Drive. Provide first-class snake_case arguments
for common request fields, or pass body for the complete Google
QueryDriveActivityRequest schema.';
    protected const PARAMETERS = array (
  'item_name' =>
  array (
    'type' => 'string',
    'description' => 'Drive item target in Google format, for example `items/file-id`.',
  ),
  'ancestor_name' =>
  array (
    'type' => 'string',
    'description' => 'Drive ancestor target in Google format, for example `items/folder-id`.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Minimum number of activities desired in the response.',
  ),
  'page_token' =>
  array (
    'type' => 'string',
    'description' => 'Token from a previous response nextPageToken.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'description' => 'Google Drive Activity filter string, for example `time >= "2026-01-01T00:00:00Z"` or `detail.action_detail_case:(CREATE EDIT)`.',
  ),
  'consolidation_strategy' =>
  array (
    'type' => 'object',
    'description' => 'Google consolidationStrategy object. Use `{legacy: {}}` for legacy-style grouping or `{none: {}}` for no consolidation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional raw JSON request body matching the official Drive Activity `QueryDriveActivityRequest` schema. First-class arguments override matching fields.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/activity:query';
    protected const BODY_REQUIRED = true;
}
