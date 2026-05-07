<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves a single combined PDF document for the documents associated with a widget.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /widgets/{widgetId}/combinedDocument.
 */
class AdobeAcrobatSignWidgetsGetWidgetCombinedDocument extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_widgets_get_widget_combined_document';
    protected const DESCRIPTION = 'Retrieves a single combined PDF document for the documents associated with a widget.

Official Adobe Acrobat Sign endpoint: GET /widgets/{widgetId}/combinedDocument

Retrieves a single combined PDF document for the documents associated with a widget.';
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
  'if_none_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Pass the value of the e-tag header obtained from the previous response to the same request to get a RESOURCE_NOT_MODIFIED(304) if the resource hasn\'t changed.',
  ),
  'widget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The version identifier of widget as provided by the API which retrieves information of a specific widget. If not provided then latest version will be used.',
  ),
  'participant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID of the participant to be used to retrieve documents.',
  ),
  'attach_audit_report' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to YES, attach an audit report to the signed Widget PDF. Default value is false',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/widgets/{widgetId}/combinedDocument';
    protected const PATH_PARAMS = array (
  'widgetId' => 'widget_id',
);
    protected const QUERY_PARAMS = array (
  'versionId' => 'version_id',
  'participantId' => 'participant_id',
  'attachAuditReport' => 'attach_audit_report',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
  'If-None-Match' => 'if_none_match',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
