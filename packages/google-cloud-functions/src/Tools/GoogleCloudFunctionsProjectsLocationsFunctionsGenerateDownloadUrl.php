<?php

namespace OpenCompany\Integrations\GoogleCloudFunctions\Tools;

/**
 * Projects Locations Functions Generate Download Url.
 *
 * Maps to the official Cloud Functions endpoint POST /v2/{+name}:generateDownloadUrl.
 */
class GoogleCloudFunctionsProjectsLocationsFunctionsGenerateDownloadUrl extends AbstractGoogleCloudFunctionsTool
{
    protected const NAME = 'google_cloud_functions_projects_locations_functions_generate_download_url';
    protected const DESCRIPTION = 'Projects Locations Functions Generate Download Url

Official Cloud Functions endpoint: POST /v2/{+name}:generateDownloadUrl
Returns a signed URL for downloading deployed function source code. The URL is only valid for a limited period and should be used within 30 minutes of generation. For more information about the signed URL usage see: https://cloud.google.com/storage/docs/access-control/signed-urls';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Cloud Functions resource names such as `projects/example/locations/us-central1/functions/api`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Functions `GenerateDownloadUrlRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/{+name}:generateDownloadUrl';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
