<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Creates a widget and and returns the widgetId in the response to the client.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /widgets.
 */
class AdobeAcrobatSignWidgetsCreateWidget extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_widgets_create_widget';
    protected const DESCRIPTION = 'Creates a widget and and returns the widgetId in the response to the client.

Official Adobe Acrobat Sign endpoint: POST /widgets

This is a primary endpoint which is used to create a new widget. You can create a widget in one of the 3 mentioned states: a) DRAFT - to incrementally build the widget, b) AUTHORING - to add/edit form fields in the widget, c) ACTIVE - to immediately host th...';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'x_on_behalf_of_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email in the format userid:{userId} OR email:{email}. of the user that has shared his/her account',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information about the widget that you want to create.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/widgets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
