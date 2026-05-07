<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the requested views of mega sign agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /megaSigns/{megaSignId}/views.
 */
class AdobeAcrobatSignMegaSignsGetMegaSignView extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_mega_sign_view';
    protected const DESCRIPTION = 'Retrieves the requested views of mega sign agreement.

Official Adobe Acrobat Sign endpoint: POST /megaSigns/{megaSignId}/views

Retrieves the requested views of mega sign agreement.';
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
  'mega_sign_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the MegaSign parent agreement, as returned by the megaSign creation API or retrieved from the API to fetch megaSign agreements',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Name of the required view and its desired configuration.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/megaSigns/{megaSignId}/views';
    protected const PATH_PARAMS = array (
  'megaSignId' => 'mega_sign_id',
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
