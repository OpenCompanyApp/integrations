<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms Create Clean Room Asset Review.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}/reviews.
 */
class DatabricksCleanroomsCreateCleanRoomAssetReview extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_create_clean_room_asset_review';
    protected const DESCRIPTION = 'Cleanrooms Create Clean Room Asset Review

Official Databricks SDK endpoint: POST /api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}/reviews

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'clean_room_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clean_room_name` from the Databricks SDK endpoint.',
  ),
  'asset_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_type` from the Databricks SDK endpoint.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}/reviews';
    protected const PATH_PARAMS = array (
  'clean_room_name' => 'clean_room_name',
  'asset_type' => 'asset_type',
  'name' => 'name',
);
}
