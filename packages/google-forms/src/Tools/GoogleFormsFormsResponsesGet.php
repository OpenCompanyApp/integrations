<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Responses Get.
 *
 * Maps to the official Google Forms endpoint GET /v1/forms/{formId}/responses/{responseId}.
 */
class GoogleFormsFormsResponsesGet extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_responses_get';
    protected const DESCRIPTION = 'Forms Responses Get

Official Google Forms endpoint: GET /v1/forms/{formId}/responses/{responseId}
Get one response from the form.';
    protected const PARAMETERS = array (
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
  'responseId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `responseId` from the official Google Forms API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/forms/{formId}/responses/{responseId}';
    protected const PATH_PARAMS = array (
  0 => 'formId',
  1 => 'responseId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
