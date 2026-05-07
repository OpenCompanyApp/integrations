<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Query Remove Activity.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/query:removeActivity.
 */
class GoogleCloudSearchQueryRemoveActivity extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_query_remove_activity';
    protected const DESCRIPTION = 'Query Remove Activity

Official Google Cloud Search endpoint: POST /v1/query:removeActivity
Provides functionality to remove logged activity for a user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `RemoveActivityRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/query:removeActivity';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
