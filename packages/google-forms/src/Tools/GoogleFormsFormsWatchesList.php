<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Watches List.
 *
 * Maps to the official Google Forms endpoint GET /v1/forms/{formId}/watches.
 */
class GoogleFormsFormsWatchesList extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_watches_list';
    protected const DESCRIPTION = 'Forms Watches List

Official Google Forms endpoint: GET /v1/forms/{formId}/watches
Return a list of the watches owned by the invoking project. The maximum number of watches is two: For each invoker, the limit is one for each event type per form.';
    protected const PARAMETERS = array (
  'formId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `formId` from the official Google Forms API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/forms/{formId}/watches';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
