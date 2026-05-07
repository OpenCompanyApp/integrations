<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves agreements for the widget.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /widgets/{widgetId}/agreements.
 */
class AdobeAcrobatSignWidgetsGetWidgetAgreements extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_widgets_get_widget_agreements';
    protected const DESCRIPTION = 'Retrieves agreements for the widget.

Official Adobe Acrobat Sign endpoint: GET /widgets/{widgetId}/agreements

Retrieves agreements for the widget.';
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
  'show_hidden_agreements' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'A query parameter to fetch all the hidden agreements along with the visible agreements.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Used to navigate through the pages. If not provided, returns the first page.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Number of intended items in the response page.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/widgets/{widgetId}/agreements';
    protected const PATH_PARAMS = array (
  'widgetId' => 'widget_id',
);
    protected const QUERY_PARAMS = array (
  'showHiddenAgreements' => 'show_hidden_agreements',
  'cursor' => 'cursor',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
