<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the file stream of the original childAgreementsInfoFile that was uploaded by sender while creating the Mega...
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /megaSigns/{megaSignId}/childAgreementsInfo/{childAgreementsInfoFileId}.
 */
class AdobeAcrobatSignMegaSignsGetChildAgreementsInfoFile extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_mega_signs_get_child_agreements_info_file';
    protected const DESCRIPTION = 'Retrieves the file stream of the original childAgreementsInfoFile that was uploaded by sender while creating the Mega...

Official Adobe Acrobat Sign endpoint: GET /megaSigns/{megaSignId}/childAgreementsInfo/{childAgreementsInfoFileId}

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
  'child_agreements_info_file_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The identifier of the childAgreementsInfoFile that has been uploaded by sender while creating the megaSign or retrieved from the API to fetch megaSignInfo',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/megaSigns/{megaSignId}/childAgreementsInfo/{childAgreementsInfoFileId}';
    protected const PATH_PARAMS = array (
  'megaSignId' => 'mega_sign_id',
  'childAgreementsInfoFileId' => 'child_agreements_info_file_id',
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
