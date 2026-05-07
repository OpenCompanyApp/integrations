<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves image urls of all visible pages of all the documents associated with an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/documents/imageUrls.
 */
class AdobeAcrobatSignAgreementsGetAllDocumentsImageUrls extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_all_documents_image_urls';
    protected const DESCRIPTION = 'Retrieves image urls of all visible pages of all the documents associated with an agreement.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/documents/imageUrls

Retrieves image urls of all visible pages of all the documents associated with an agreement.';
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
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The version identifier of agreement as provided by the API which retrieves information of a specific agreement. If not provided then latest version will be used.',
  ),
  'participant_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The participant identifier to be used to retrieve documents.',
  ),
  'image_sizes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma separated list of image sizes i.e. {FIXED_WIDTH_50px, FIXED_WIDTH_250px, FIXED_WIDTH_675px, ZOOM_50_PERCENT, ZOOM_75_PERCENT, ZOOM_100_PERCENT, ZOOM_125_PERCENT, ZOOM_150_PERCENT, ZOOM_200_PERCENT}. Default sizes returned are {FI...',
  ),
  'include_supporting_documents_image_urls' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, returns image urls of supporting documents as well. Else, returns image urls of only the original documents.',
  ),
  'show_image_availability_only' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, returns only image availability. Else, returns both image urls and its availability.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/documents/imageUrls';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
  'versionId' => 'version_id',
  'participantId' => 'participant_id',
  'imageSizes' => 'image_sizes',
  'includeSupportingDocumentsImageUrls' => 'include_supporting_documents_image_urls',
  'showImageAvailabilityOnly' => 'show_image_availability_only',
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
