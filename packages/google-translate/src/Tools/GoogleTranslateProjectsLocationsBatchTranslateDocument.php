<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Batch Translate Document.
 *
 * Maps to the official Cloud Translation endpoint POST /v3/{+parent}:batchTranslateDocument.
 */
class GoogleTranslateProjectsLocationsBatchTranslateDocument extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_batch_translate_document';
    protected const DESCRIPTION = 'Projects Locations Batch Translate Document

Official Google Cloud Translation endpoint: POST /v3/{+parent}:batchTranslateDocument
Translates a large volume of document in asynchronous batch mode. This function provides real-time output as the inputs are being processed. If caller cancels a request, the partial results (for an input file, it\'s all or nothing) may still be available on the specified output location. This call returns immediately and you can use google.longrunning.Operation.name to poll the status of the call.';
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
    'description' => 'JSON request body matching the official Cloud Translation API `BatchTranslateDocumentRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v3/{+parent}:batchTranslateDocument';
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
