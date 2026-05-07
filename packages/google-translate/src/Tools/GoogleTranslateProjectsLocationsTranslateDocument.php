<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Translate Document.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:translateDocument.
 */
class GoogleTranslateProjectsLocationsTranslateDocument extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_translate_document';
    protected const DESCRIPTION = 'Projects Locations Translate Document

Official Google Cloud Translation endpoint: POST /v3/{+parent}:translateDocument
Translates documents in synchronous mode.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `TranslateDocumentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:translateDocument';
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
