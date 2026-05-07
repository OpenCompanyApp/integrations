<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Get.
 *
 * Maps to the official Google Forms endpoint GET /v1/forms/{formId}.
 */
class GoogleFormsFormsGet extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_get';
    protected const DESCRIPTION = 'Forms Get

Official Google Forms endpoint: GET /v1/forms/{formId}
Get a form.';
    protected const PARAMETERS = array (
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/forms/{formId}';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
