<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Adaptive Mt Datasets Import Adaptive Mt File.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:importAdaptiveMtFile.
 */
class GoogleTranslateProjectsLocationsAdaptiveMtDatasetsImportAdaptiveMtFile extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_adaptive_mt_datasets_import_adaptive_mt_file';
    protected const DESCRIPTION = 'Projects Locations Adaptive Mt Datasets Import Adaptive Mt File

Official Google Cloud Translation endpoint: POST /v3/{+parent}:importAdaptiveMtFile
Imports an AdaptiveMtFile and adds all of its sentences into the AdaptiveMtDataset.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Cloud Translation API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Cloud Translation API `ImportAdaptiveMtFileRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:importAdaptiveMtFile';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
