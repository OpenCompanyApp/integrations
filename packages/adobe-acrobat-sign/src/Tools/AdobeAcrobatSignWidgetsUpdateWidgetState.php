<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Updates the state of a widget identified by widgetId in the path.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /widgets/{widgetId}/state.
 */
class AdobeAcrobatSignWidgetsUpdateWidgetState extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_widgets_update_widget_state';
    protected const DESCRIPTION = 'Updates the state of a widget identified by widgetId in the path.

Official Adobe Acrobat Sign endpoint: PUT /widgets/{widgetId}/state

This endpoint can be used by creator of the widget to transition between the states of widget. An allowed transition would follow any of the following sequence : DRAFT->AUTHORING->ACTIVE, ACTIVEINACTIVE, DRAFT->CANCELLED.';
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
  'if_match' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
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
    'description' => '',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/widgets/{widgetId}/state';
    protected const PATH_PARAMS = array (
  'widgetId' => 'widget_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-Match' => 'if_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
