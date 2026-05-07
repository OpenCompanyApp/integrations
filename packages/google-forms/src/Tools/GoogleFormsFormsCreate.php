<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

/**
 * Forms Create.
 *
 * Maps to the official Google Forms endpoint POST /v1/forms.
 */
class GoogleFormsFormsCreate extends AbstractGoogleFormsTool
{
    protected const NAME = 'google_forms_forms_create';
    protected const DESCRIPTION = 'Forms Create

Official Google Forms endpoint: POST /v1/forms
Create a new form using the title given in the provided form message in the request. *Important:* Only the form.info.title and form.info.document_title fields are copied to the new form. All other fields including the form description, items and settings are disallowed. To create a new form and add items, you must first call forms.create to create an empty form with a title and (optional) document title, and then call forms.update to add the items.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Forms method. Known keys: unpublished.',
  ),
  'unpublished' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Whether the form is unpublished. If set to `true`, the form doesn\'t accept responses. If set to `false` or unset, the form is published and accepts responses.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Forms API `Form` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/forms';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'unpublished',
);
    protected const BODY_REQUIRED = true;
}
