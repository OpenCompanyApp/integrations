<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Get detailed information of the specified MegaSign parent agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /megaSigns/{megaSignId}.
 */
class AdobeAcrobatSignMegaSignsGetMegaSignInfo extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_mega_sign_info';
    protected const DESCRIPTION = 'Get detailed information of the specified MegaSign parent agreement.

Official Adobe Acrobat Sign endpoint: GET /megaSigns/{megaSignId}

Get detailed information of the specified MegaSign parent agreement.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/megaSigns/{megaSignId}';
    protected const PATH_PARAMS = array (
  'megaSignId' => 'mega_sign_id',
);
    protected const QUERY_PARAMS = array (
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
