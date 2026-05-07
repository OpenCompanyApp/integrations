<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Creates an agreement. Sends it out for signatures, and returns the agreementID in the response to the client.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /agreements.
 */
class AdobeAcrobatSignAgreementsCreateAgreement extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_agreements_create_agreement';
    protected const DESCRIPTION = 'Creates an agreement. Sends it out for signatures, and returns the agreementID in the response to the client.

Official Adobe Acrobat Sign endpoint: POST /agreements

This is a primary endpoint which is used to create a new agreement. An agreement can be created using transientDocument, libraryDocument or a URL. You can create an agreement in one of the 3 mentioned states: a) DRAFT - to incrementally build the agreement...';
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
    'description' => 'Information about the agreement that you want to create.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/agreements';
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
