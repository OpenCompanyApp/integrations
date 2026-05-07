<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Searchapplications Create.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/settings/searchapplications.
 */
class GoogleCloudSearchSettingsSearchapplicationsCreate extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_searchapplications_create';
    protected const DESCRIPTION = 'Settings Searchapplications Create

Official Google Cloud Search endpoint: POST /v1/settings/searchapplications
Creates a search application.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `SearchApplication` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/settings/searchapplications';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
