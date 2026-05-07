<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Batch Update.
 *
 * Maps to the official Google Forms endpoint POST /v1/forms/{formId}:batchUpdate.
 */
class GoogleFormsFormsBatchUpdate extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_batch_update';
    protected const DESCRIPTION = 'Forms Batch Update

Official Google Forms endpoint: POST /v1/forms/{formId}:batchUpdate
Change the form with a batch of updates.';
    protected const PARAMETERS = array (
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Forms API `BatchUpdateFormRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/forms/{formId}:batchUpdate';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
