<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Datasources Create.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/settings/datasources.
 */
class GoogleCloudSearchSettingsDatasourcesCreate extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_datasources_create';
    protected const DESCRIPTION = 'Settings Datasources Create

Official Google Cloud Search endpoint: POST /v1/settings/datasources
Creates a datasource.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `DataSource` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/settings/datasources';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
