<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves image urls of all visible pages of a document associated with an agreement.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /agreements/{agreementId}/documents/{documentId}/imageUrls.
 */
class AdobeAcrobatSignAgreementsGetDocumentImageUrls extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_get_document_image_urls';
    protected const DESCRIPTION = 'Retrieves image urls of all visible pages of a document associated with an agreement.

Official Adobe Acrobat Sign endpoint: GET /agreements/{agreementId}/documents/{documentId}/imageUrls

Retrieves image urls of all visible pages of a document associated with an agreement.';
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
  'document_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The document identifier, as retrieved from the API which fetches the documents of a specified agreement',
  ),
  'image_sizes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'A comma separated list of image sizes i.e. {FIXED_WIDTH_50px, FIXED_WIDTH_250px, FIXED_WIDTH_675px, ZOOM_50_PERCENT, ZOOM_75_PERCENT, ZOOM_100_PERCENT, ZOOM_125_PERCENT, ZOOM_150_PERCENT, ZOOM_200_PERCENT}. Default sizes returned are {FI...',
  ),
  'show_image_availability_only' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'When set to true, returns only image availability. Else, returns both image urls and its availability.',
  ),
  'start_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Start of page number range for which imageUrls are requested. Starting page number should be greater than 0.',
  ),
  'end_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'End of page number range for which imageUrls are requested.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/agreements/{agreementId}/documents/{documentId}/imageUrls';
    protected const PATH_PARAMS = array (
  'agreementId' => 'agreement_id',
  'documentId' => 'document_id',
);
    protected const QUERY_PARAMS = array (
  'imageSizes' => 'image_sizes',
  'showImageAvailabilityOnly' => 'show_image_availability_only',
  'startPage' => 'start_page',
  'endPage' => 'end_page',
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
