<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Watches Create.
 *
 * Maps to the official Google Forms endpoint POST /v1/forms/{formId}/watches.
 */
class GoogleFormsFormsWatchesCreate extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_watches_create';
    protected const DESCRIPTION = 'Forms Watches Create

Official Google Forms endpoint: POST /v1/forms/{formId}/watches
Create a new watch. If a watch ID is provided, it must be unused. For each invoking project, the per form limit is one watch per Watch.EventType. A watch expires seven days after it is created (see Watch.expire_time).';
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
    'description' => 'JSON request body matching the official Google Forms API `CreateWatchRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/forms/{formId}/watches';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
