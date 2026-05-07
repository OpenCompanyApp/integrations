<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves MegaSign parent agreements for a user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /megaSigns.
 */
class AdobeAcrobatSignMegaSignsGetMegaSigns extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_mega_signs';
    protected const DESCRIPTION = 'Retrieves MegaSign parent agreements for a user.

Official Adobe Acrobat Sign endpoint: GET /megaSigns

Retrieves MegaSign parent agreements for a user.';
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
    protected const PATH = '/megaSigns';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
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
