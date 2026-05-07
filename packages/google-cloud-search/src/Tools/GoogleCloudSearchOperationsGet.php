<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Operations Get.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/{+name}.
 */
class GoogleCloudSearchOperationsGet extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_operations_get';
    protected const DESCRIPTION = 'Operations Get

Official Google Cloud Search endpoint: GET /v1/{+name}
Gets the latest state of a long-running operation.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
