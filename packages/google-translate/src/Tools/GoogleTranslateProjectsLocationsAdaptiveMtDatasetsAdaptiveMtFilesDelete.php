<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Adaptive Mt Datasets Adaptive Mt Files Delete.
 *
 * Maps to the official Cloud Translation endpoint DELETE /v3/{+name}.
 */
class GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesDelete extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_delete';
    protected const DESCRIPTION = 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Delete

Official Google Cloud Translation endpoint: DELETE /v3/{+name}
Deletes an AdaptiveMtFile along with its sentences.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Cloud Translation API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/{+name}';
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
