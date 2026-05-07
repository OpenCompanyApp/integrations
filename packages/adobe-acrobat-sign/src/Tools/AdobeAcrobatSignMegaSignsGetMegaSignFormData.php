<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves data entered by recipients into interactive form fields at the time they signed the child agreements of the...
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /megaSigns/{megaSignId}/formData.
 */
class AdobeAcrobatSignMegaSignsGetMegaSignFormData extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_mega_sign_form_data';
    protected const DESCRIPTION = 'Retrieves data entered by recipients into interactive form fields at the time they signed the child agreements of the...

Official Adobe Acrobat Sign endpoint: GET /megaSigns/{megaSignId}/formData

CSV file stream containing form data information';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/megaSigns/{megaSignId}/formData';
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
    protected const BODY_REQUIRED = false;
}
