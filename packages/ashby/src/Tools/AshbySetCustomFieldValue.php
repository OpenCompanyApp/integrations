<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Set a custom field value in Ashby. */
class AshbySetCustomFieldValue extends AbstractAshbyTool
{
    protected const NAME = 'ashby_set_custom_field_value';
    protected const DESCRIPTION = 'Set a custom field value on an Ashby entity using customFields.setValue.';
    protected const ENDPOINT = '/customFields.setValue';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw customFields.setValue body from Ashby docs.'],
    ];
}
