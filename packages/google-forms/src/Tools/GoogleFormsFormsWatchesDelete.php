<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Watches Delete.
 *
 * Maps to the official Google Forms endpoint DELETE /v1/forms/{formId}/watches/{watchId}.
 */
class GoogleFormsFormsWatchesDelete extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_watches_delete';
    protected const DESCRIPTION = 'Forms Watches Delete

Official Google Forms endpoint: DELETE /v1/forms/{formId}/watches/{watchId}
Delete a watch.';
    protected const PARAMETERS = array (
  'watchId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `watchId` from the official Google Forms API method.',
  ),
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/forms/{formId}/watches/{watchId}';
    protected const PATH_PARAMS = array (
  0 => 'watchId',
  1 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
