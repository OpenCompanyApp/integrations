<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Set Publish Settings.
 *
 * Maps to the official Google Forms endpoint POST /v1/forms/{formId}:setPublishSettings.
 */
class GoogleFormsFormsSetPublishSettings extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_set_publish_settings';
    protected const DESCRIPTION = 'Forms Set Publish Settings

Official Google Forms endpoint: POST /v1/forms/{formId}:setPublishSettings
Updates the publish settings of a form. Legacy forms aren\'t supported because they don\'t have the `publish_settings` field.';
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
    'description' => 'JSON request body matching the official Google Forms API `SetPublishSettingsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/forms/{formId}:setPublishSettings';
    protected const PATH_PARAMS = array (
  0 => 'formId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
