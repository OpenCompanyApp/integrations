<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Update.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/settings/types/dashboard_email_subscriptions/names/default.
 */
class DatabricksSettingsUpdate7 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_update_7';
    protected const DESCRIPTION = 'Settings Update

Official Databricks SDK endpoint: PATCH /api/2.0/settings/types/dashboard_email_subscriptions/names/default

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/settings/types/dashboard_email_subscriptions/names/default';
    protected const PATH_PARAMS = array (
);
}
