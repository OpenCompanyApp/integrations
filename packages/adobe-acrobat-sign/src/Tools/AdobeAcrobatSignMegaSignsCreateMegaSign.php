<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Send an agreement out for signature to multiple recipients. Each recipient will receive and sign their own copy of th...
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /megaSigns.
 */
class AdobeAcrobatSignMegaSignsCreateMegaSign extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_create_mega_sign';
    protected const DESCRIPTION = 'Send an agreement out for signature to multiple recipients. Each recipient will receive and sign their own copy of th...

Official Adobe Acrobat Sign endpoint: POST /megaSigns

This is a primary endpoint which is used to create a new megaSign. A megaSign can be created using transientDocument, libraryDocument or a URL. You can create a megaSign in IN_PROCESS - Create a megaSign in this state to immediately send it. You can use the...';
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
    'description' => 'Information about the MegaSign that you want to send.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/megaSigns';
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
