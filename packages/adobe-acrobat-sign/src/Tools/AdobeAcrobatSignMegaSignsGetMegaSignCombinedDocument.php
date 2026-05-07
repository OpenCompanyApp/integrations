<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /megaSigns/{megaSignId}/combinedDocument.
 */
class AdobeAcrobatSignMegaSignsGetMegaSignCombinedDocument extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_mega_sign_combined_document';
    protected const DESCRIPTION = 'Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.

Official Adobe Acrobat Sign endpoint: GET /megaSigns/{megaSignId}/combinedDocument

Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.';
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
  'mega_sign_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the MegaSign parent agreement, as returned by the megaSign creation API or retrieved from the API to fetch megaSign agreements',
  ),
  'attach_audit_report' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true attach an audit report to the MegaSign document PDF. Default value will be false.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/megaSigns/{megaSignId}/combinedDocument';
    protected const PATH_PARAMS = array (
  'megaSignId' => 'mega_sign_id',
);
    protected const QUERY_PARAMS = array (
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
