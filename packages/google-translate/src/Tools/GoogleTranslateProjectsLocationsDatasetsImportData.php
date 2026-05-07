<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Datasets Import Data.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+dataset}:importData.
 */
class GoogleTranslateProjectsLocationsDatasetsImportData extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_datasets_import_data';
    protected const DESCRIPTION = 'Projects Locations Datasets Import Data

Official Google Cloud Translation endpoint: POST /v3/{+dataset}:importData
Import sentence pairs into translation Dataset.';
    protected const PARAMETERS = array (
  'dataset' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset` from the official Cloud Translation API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Translation API `ImportDataRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+dataset}:importData';
    protected const PATH_PARAMS = array (
  0 => 'dataset',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'dataset',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
