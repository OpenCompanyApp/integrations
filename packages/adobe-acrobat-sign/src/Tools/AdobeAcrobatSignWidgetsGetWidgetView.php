<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the requested views for a widget.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /widgets/{widgetId}/views.
 */
class AdobeAcrobatSignWidgetsGetWidgetView extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_widgets_get_widget_view';
    protected const DESCRIPTION = 'Retrieves the requested views for a widget.

Official Adobe Acrobat Sign endpoint: POST /widgets/{widgetId}/views

Retrieves the requested views for a widget.';
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
  'widget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Name of the required view and its desired configuration.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/widgets/{widgetId}/views';
    protected const PATH_PARAMS = array (
  'widgetId' => 'widget_id',
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
