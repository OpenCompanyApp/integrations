<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Watches Renew.
 *
 * Maps to the official Google Forms endpoint POST /v1/forms/{formId}/watches/{watchId}:renew.
 */
class GoogleFormsFormsWatchesRenew extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_watches_renew';
    protected const DESCRIPTION = 'Forms Watches Renew

Official Google Forms endpoint: POST /v1/forms/{formId}/watches/{watchId}:renew
Renew an existing watch for seven days. The state of the watch after renewal is `ACTIVE`, and the `expire_time` is seven days from the renewal. Renewing a watch in an error state (e.g. `SUSPENDED`) succeeds if the error is no longer present, but fail otherwise. After a watch has expired, RenewWatch returns `NOT_FOUND`.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Forms API `RenewWatchRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/forms/{formId}/watches/{watchId}:renew';
    protected const PATH_PARAMS = array (
  0 => 'watchId',
  1 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
