<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign;

/**
 * Official Adobe Acrobat Sign REST v6 operation metadata.
 *
 * Generated from Adobe's published Swagger JSON resources.
 */
class AdobeAcrobatSignOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'adobe_acrobat_sign_agreements_create_agreement' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_create_agreement',
    'class' => 'AdobeAcrobatSignAgreementsCreateAgreement',
    'method' => 'POST',
    'path' => '/agreements',
    'resource' => 'agreements',
    'operation_id' => 'createAgreement',
    'name' => 'Creates an agreement. Sends it out for signatures, and returns the agreementID in the response to the client.',
    'description' => 'This is a primary endpoint which is used to create a new agreement. An agreement can be created using transientDocument, libraryDocument or a URL. You can create an agreement in one of the 3 mentioned states: a) DRAFT - to incrementally build the agreement...',
    'type' => 'write',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_add_template_fields_to_agreement' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_add_template_fields_to_agreement',
    'class' => 'AdobeAcrobatSignAgreementsAddTemplateFieldsToAgreement',
    'method' => 'POST',
    'path' => '/agreements/{agreementId}/formFields',
    'resource' => 'agreements',
    'operation_id' => 'addTemplateFieldsToAgreement',
    'name' => 'Adds template fields to an agreement',
    'description' => 'Adds template fields to an agreement',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'List of form fields to add or replace',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_create_delegated_participant_sets' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_create_delegated_participant_sets',
    'class' => 'AdobeAcrobatSignAgreementsCreateDelegatedParticipantSets',
    'method' => 'POST',
    'path' => '/agreements/{agreementId}/members/participantSets/{participantSetId}/delegatedParticipantSets',
    'resource' => 'agreements',
    'operation_id' => 'createDelegatedParticipantSets',
    'name' => 'Creates a participantSet to which the agreement is forwarded for taking appropriate action.',
    'description' => 'Participants marked as delegator can call this API endpoint.',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'participant_set_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant set identifier',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the delegate participant Set',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'participantSetId' => 'participant_set_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_create_share_on_agreement' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_create_share_on_agreement',
    'class' => 'AdobeAcrobatSignAgreementsCreateShareOnAgreement',
    'method' => 'POST',
    'path' => '/agreements/{agreementId}/members/share',
    'resource' => 'agreements',
    'operation_id' => 'createShareOnAgreement',
    'name' => 'Share an agreement with someone.',
    'description' => 'Share an agreement with someone.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'List of agreement share creation information objects.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_create_reminder_on_participant' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_create_reminder_on_participant',
    'class' => 'AdobeAcrobatSignAgreementsCreateReminderOnParticipant',
    'method' => 'POST',
    'path' => '/agreements/{agreementId}/reminders',
    'resource' => 'agreements',
    'operation_id' => 'createReminderOnParticipant',
    'name' => 'Creates a reminder on the specified participants of an agreement identified by agreementId in the path.',
    'description' => 'Creates a reminder on the specified participants of an agreement identified by agreementId in the path.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'The information about the reminder that you want to create on the participantSet of the agreement.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_create_agreement_view' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_create_agreement_view',
    'class' => 'AdobeAcrobatSignAgreementsCreateAgreementView',
    'method' => 'POST',
    'path' => '/agreements/{agreementId}/views',
    'resource' => 'agreements',
    'operation_id' => 'createAgreementView',
    'name' => 'Retrieves the latest state view url of agreement.',
    'description' => 'Retrieves the latest state view url of agreement.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Name of the required view and its desired configuration.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_get_agreements' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_agreements',
    'class' => 'AdobeAcrobatSignAgreementsGetAgreements',
    'method' => 'GET',
    'path' => '/agreements',
    'resource' => 'agreements',
    'operation_id' => 'getAgreements',
    'name' => 'Retrieves agreements for the user.',
    'description' => 'Retrieves agreements for the user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'external_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Case-sensitive ExternalID for which you would like to retrieve agreement information. ExternalId is passed in the call to the agreement creation API',
      ),
      'show_hidden_agreements' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch all the hidden agreements along with the visible agreements.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'externalId' => 'external_id',
      'showHiddenAgreements' => 'show_hidden_agreements',
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_agreement_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_agreement_info',
    'class' => 'AdobeAcrobatSignAgreementsGetAgreementInfo',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}',
    'resource' => 'agreements',
    'operation_id' => 'getAgreementInfo',
    'name' => 'Retrieves the current status of an agreement.',
    'description' => 'Retrieves the current status of an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_audit_trail' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_audit_trail',
    'class' => 'AdobeAcrobatSignAgreementsGetAuditTrail',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/auditTrail',
    'resource' => 'agreements',
    'operation_id' => 'getAuditTrail',
    'name' => 'Retrieves the audit trail of an agreement identified by agreementId.',
    'description' => 'PDF file stream containing audit trail information',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_combined_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_combined_document',
    'class' => 'AdobeAcrobatSignAgreementsGetCombinedDocument',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/combinedDocument',
    'resource' => 'agreements',
    'operation_id' => 'getCombinedDocument',
    'name' => 'Retrieves a single combined PDF document for the documents associated with an agreement.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'attach_supporting_documents' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to true, attach corresponding supporting documents to the signed agreement PDF. Default value of this parameter is true.',
      ),
      'attach_audit_report' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to true, attach an audit report to the signed agreement PDF. Default value is false',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
      'participantId' => 'participant_id',
      'attachSupportingDocuments' => 'attach_supporting_documents',
      'attachAuditReport' => 'attach_audit_report',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_combined_document_pages_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_combined_document_pages_info',
    'class' => 'AdobeAcrobatSignAgreementsGetCombinedDocumentPagesInfo',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/combinedDocument/pagesInfo',
    'resource' => 'agreements',
    'operation_id' => 'getCombinedDocumentPagesInfo',
    'name' => 'Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.',
    'description' => 'Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'include_supporting_documents_pages_info' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to true, returns info of all pages of supporting documents as well. Else, return the info of pages of only the original document.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'includeSupportingDocumentsPagesInfo' => 'include_supporting_documents_pages_info',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_all_documents' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_all_documents',
    'class' => 'AdobeAcrobatSignAgreementsGetAllDocuments',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/documents',
    'resource' => 'agreements',
    'operation_id' => 'getAllDocuments',
    'name' => 'Retrieves the IDs of the documents of an agreement identified by agreementId.',
    'description' => 'Retrieves the IDs of the documents of an agreement identified by agreementId.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'supporting_document_content_format' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Content format of the supported documents. It can have two possible values ORIGINAL or CONVERTED_PDF.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
      'participantId' => 'participant_id',
      'supportingDocumentContentFormat' => 'supporting_document_content_format',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_document',
    'class' => 'AdobeAcrobatSignAgreementsGetDocument',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/documents/{documentId}',
    'resource' => 'agreements',
    'operation_id' => 'getDocument',
    'name' => 'Retrieves the file stream of a document of an agreement.',
    'description' => 'Retrieves the file stream of a document of an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'documentId' => 'document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_document_image_urls' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_document_image_urls',
    'class' => 'AdobeAcrobatSignAgreementsGetDocumentImageUrls',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/documents/{documentId}/imageUrls',
    'resource' => 'agreements',
    'operation_id' => 'getDocumentImageUrls',
    'name' => 'Retrieves image urls of all visible pages of a document associated with an agreement.',
    'description' => 'Retrieves image urls of all visible pages of a document associated with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'documentId' => 'document_id',
    ),
    'query_params' =>
    array (
      'imageSizes' => 'image_sizes',
      'showImageAvailabilityOnly' => 'show_image_availability_only',
      'startPage' => 'start_page',
      'endPage' => 'end_page',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_all_documents_image_urls' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_all_documents_image_urls',
    'class' => 'AdobeAcrobatSignAgreementsGetAllDocumentsImageUrls',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/documents/imageUrls',
    'resource' => 'agreements',
    'operation_id' => 'getAllDocumentsImageUrls',
    'name' => 'Retrieves image urls of all visible pages of all the documents associated with an agreement.',
    'description' => 'Retrieves image urls of all visible pages of all the documents associated with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
      'participantId' => 'participant_id',
      'imageSizes' => 'image_sizes',
      'includeSupportingDocumentsImageUrls' => 'include_supporting_documents_image_urls',
      'showImageAvailabilityOnly' => 'show_image_availability_only',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_events' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_events',
    'class' => 'AdobeAcrobatSignAgreementsGetEvents',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/events',
    'resource' => 'agreements',
    'operation_id' => 'getEvents',
    'name' => 'Retrieves the events information for an agreement.',
    'description' => 'Retrieves the events information for an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_form_data' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_form_data',
    'class' => 'AdobeAcrobatSignAgreementsGetFormData',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/formData',
    'resource' => 'agreements',
    'operation_id' => 'getFormData',
    'name' => 'Retrieves data entered into the interactive form fields of the agreement.',
    'description' => 'This API can only be called by the creator of the agreement',
    'type' => 'read',
    'parameters' =>
    array (
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
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_form_fields' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_form_fields',
    'class' => 'AdobeAcrobatSignAgreementsGetFormFields',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/formFields',
    'resource' => 'agreements',
    'operation_id' => 'getFormFields',
    'name' => 'Retrieves details of form fields of an agreement.',
    'description' => 'Retrieves details of form fields of an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'participant_email' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The email address of the participant to be used to retrieve its associated form fields.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'participantEmail' => 'participant_email',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_merge_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_merge_info',
    'class' => 'AdobeAcrobatSignAgreementsGetMergeInfo',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/formFields/mergeInfo',
    'resource' => 'agreements',
    'operation_id' => 'getMergeInfo',
    'name' => 'Retrieves the merge info stored with an agreement.',
    'description' => 'Retrieves the merge info stored with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_agreement_note_for_api_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_agreement_note_for_api_user',
    'class' => 'AdobeAcrobatSignAgreementsGetAgreementNoteForApiUser',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/me/note',
    'resource' => 'agreements',
    'operation_id' => 'getAgreementNoteForApiUser',
    'name' => 'Retrieves the latest note associated with an agreement.',
    'description' => 'Retrieves the latest note associated with an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_all_members' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_all_members',
    'class' => 'AdobeAcrobatSignAgreementsGetAllMembers',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/members',
    'resource' => 'agreements',
    'operation_id' => 'getAllMembers',
    'name' => 'Retrieves information of members of the agreement.',
    'description' => 'Retrieves information of members of the agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'include_next_participant_set' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch next active participation members',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'includeNextParticipantSet' => 'include_next_participant_set',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_participant_set' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_participant_set',
    'class' => 'AdobeAcrobatSignAgreementsGetParticipantSet',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/members/participantSets/{participantSetId}',
    'resource' => 'agreements',
    'operation_id' => 'getParticipantSet',
    'name' => 'Retrieves the participant set of an agreement identified by agreementId in the path.',
    'description' => 'Retrieves the participant set of an agreement identified by agreementId in the path.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'participant_set_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant set identifier',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'participantSetId' => 'participant_set_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_signing_url' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_signing_url',
    'class' => 'AdobeAcrobatSignAgreementsGetSigningUrl',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/signingUrls',
    'resource' => 'agreements',
    'operation_id' => 'getSigningUrl',
    'name' => 'Retrieves the URL for the e-sign page for the current signer(s) of an agreement.',
    'description' => 'Retrieves the URL for the e-sign page for the current signer(s) of an agreement.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'if_none_match' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Pass the value of the e-tag header obtained from the previous response to the same request to get a RESOURCE_NOT_MODIFIED(304) if the resource hasn\'t changed.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_get_agreement_reminders' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_get_agreement_reminders',
    'class' => 'AdobeAcrobatSignAgreementsGetAgreementReminders',
    'method' => 'GET',
    'path' => '/agreements/{agreementId}/reminders',
    'resource' => 'agreements',
    'operation_id' => 'getAgreementReminders',
    'name' => 'Retrieves the reminders of an agreement, identified by agreementId in the path.',
    'description' => 'Retrieves the reminders of an agreement, identified by agreementId in the path.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'status' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of reminder statuses of the reminders which should be returned in the response. Currently supported values are ACTIVE, CANCELED, COMPLETE',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
      'status' => 'status',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_agreements_update_agreement' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_agreement',
    'class' => 'AdobeAcrobatSignAgreementsUpdateAgreement',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}',
    'resource' => 'agreements',
    'operation_id' => 'updateAgreement',
    'name' => 'Updates the agreement in draft state.',
    'description' => 'Updates the agreement in draft state.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information necessary to update a modifiable agreement that is presently out for signature.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_update_form_fields' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_form_fields',
    'class' => 'AdobeAcrobatSignAgreementsUpdateFormFields',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/formFields',
    'resource' => 'agreements',
    'operation_id' => 'updateFormFields',
    'name' => 'Updates form fields of an agreement.',
    'description' => 'Updates form fields of an agreement.',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'List of form fields to add or replace',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_update_agreement_merge_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_agreement_merge_info',
    'class' => 'AdobeAcrobatSignAgreementsUpdateAgreementMergeInfo',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/formFields/mergeInfo',
    'resource' => 'agreements',
    'operation_id' => 'updateAgreementMergeInfo',
    'name' => 'Set the merge info for an agreement.',
    'description' => 'Set the merge info for an agreement.',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'A mapping indicating the default values to set for form fields',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_update_agreement_visibility' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_agreement_visibility',
    'class' => 'AdobeAcrobatSignAgreementsUpdateAgreementVisibility',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/me/visibility',
    'resource' => 'agreements',
    'operation_id' => 'updateAgreementVisibility',
    'name' => 'Updates the visibility of an agreement.',
    'description' => 'Updates the visibility of an agreement.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information to update visibility of agreement',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_update_participant_set' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_participant_set',
    'class' => 'AdobeAcrobatSignAgreementsUpdateParticipantSet',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/members/participantSets/{participantSetId}',
    'resource' => 'agreements',
    'operation_id' => 'updateParticipantSet',
    'name' => 'Updates the participant set of an agreement identified by agreementId in the path.',
    'description' => 'Updates the participant set of an agreement identified by agreementId in the path.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'participant_set_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant set identifier',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'The new participant set info.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'participantSetId' => 'participant_set_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_reject_agreement_for_participation' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_reject_agreement_for_participation',
    'class' => 'AdobeAcrobatSignAgreementsRejectAgreementForParticipation',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/members/participantSets/{participantSetId}/participants/{participantId}/reject',
    'resource' => 'agreements',
    'operation_id' => 'rejectAgreementForParticipation',
    'name' => 'Rejects the agreement for a participant.',
    'description' => 'Rejects the agreement for a participant.',
    'type' => 'write',
    'parameters' =>
    array (
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'participant_set_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant set identifier',
      ),
      'participant_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant identifier',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Participant rejection information required for rejecting the agreement',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
      'participantSetId' => 'participant_set_id',
      'participantId' => 'participant_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'If-Match' => 'if_match',
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_update_agreement_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_update_agreement_state',
    'class' => 'AdobeAcrobatSignAgreementsUpdateAgreementState',
    'method' => 'PUT',
    'path' => '/agreements/{agreementId}/state',
    'resource' => 'agreements',
    'operation_id' => 'updateAgreementState',
    'name' => 'Updates the state of an agreement identified by agreementId in the path.',
    'description' => 'This endpoint can be used by originator/sender of an agreement to transition between the states of agreement. An allowed transition would follow the following sequence: DRAFT -> AUTHORING -> IN_PROCESS -> CANCELLED.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => '',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_agreements_delete_documents' =>
  array (
    'slug' => 'adobe_acrobat_sign_agreements_delete_documents',
    'class' => 'AdobeAcrobatSignAgreementsDeleteDocuments',
    'method' => 'DELETE',
    'path' => '/agreements/{agreementId}/documents',
    'resource' => 'agreements',
    'operation_id' => 'deleteDocuments',
    'name' => 'Deletes all the documents of an agreement.',
    'description' => 'Deletes all the documents of an agreement.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'agreement_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The agreement identifier, as returned by the agreement creation API or retrieved from the API to fetch agreements.',
      ),
    ),
    'path_params' =>
    array (
      'agreementId' => 'agreement_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_base_uris_get_base_uris' =>
  array (
    'slug' => 'adobe_acrobat_sign_base_uris_get_base_uris',
    'class' => 'AdobeAcrobatSignBaseUrisGetBaseUris',
    'method' => 'GET',
    'path' => '/baseUris',
    'resource' => 'baseUris',
    'operation_id' => 'getBaseUris',
    'name' => 'Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be consid...',
    'description' => 'Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be considered an invalid request.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_groups_get_groups' =>
  array (
    'slug' => 'adobe_acrobat_sign_groups_get_groups',
    'class' => 'AdobeAcrobatSignGroupsGetGroups',
    'method' => 'GET',
    'path' => '/groups',
    'resource' => 'groups',
    'operation_id' => 'getGroups',
    'name' => 'Retrieves all the groups in an account.',
    'description' => 'Retrieves all the groups in an account.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_groups_get_group_details' =>
  array (
    'slug' => 'adobe_acrobat_sign_groups_get_group_details',
    'class' => 'AdobeAcrobatSignGroupsGetGroupDetails',
    'method' => 'GET',
    'path' => '/groups/{groupId}',
    'resource' => 'groups',
    'operation_id' => 'getGroupDetails',
    'name' => 'Retrieves detailed information about the group.',
    'description' => 'Retrieves detailed information about the group.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The group identifier, as returned by the group creation API or retrieved from the API to fetch groups',
      ),
    ),
    'path_params' =>
    array (
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_groups_get_users_in_group' =>
  array (
    'slug' => 'adobe_acrobat_sign_groups_get_users_in_group',
    'class' => 'AdobeAcrobatSignGroupsGetUsersInGroup',
    'method' => 'GET',
    'path' => '/groups/{groupId}/users',
    'resource' => 'groups',
    'operation_id' => 'getUsersInGroup',
    'name' => 'Retrieves all the users in a group.',
    'description' => 'Retrieves all the users in a group.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
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
      'group_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The group identifier, as returned by the group creation API or retrieved from the API to fetch groups',
      ),
    ),
    'path_params' =>
    array (
      'groupId' => 'group_id',
    ),
    'query_params' =>
    array (
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_create_library_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_create_library_document',
    'class' => 'AdobeAcrobatSignLibraryDocumentsCreateLibraryDocument',
    'method' => 'POST',
    'path' => '/libraryDocuments',
    'resource' => 'libraryDocuments',
    'operation_id' => 'createLibraryDocument',
    'name' => 'Creates a template that is placed in the library of the user for reuse.',
    'description' => 'Creates a template that is placed in the library of the user for reuse.',
    'type' => 'write',
    'parameters' =>
    array (
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
        'description' => 'Information about the library document that you want to create.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_library_documents_create_library_document_view' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_create_library_document_view',
    'class' => 'AdobeAcrobatSignLibraryDocumentsCreateLibraryDocumentView',
    'method' => 'POST',
    'path' => '/libraryDocuments/{libraryDocumentId}/views',
    'resource' => 'libraryDocuments',
    'operation_id' => 'createLibraryDocumentView',
    'name' => 'Retrieves the latest state view url of a library document.',
    'description' => 'Retrieves the latest state view url of a library document.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Name of the required view and its desired configuration.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_library_documents_get_library_documents' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_documents',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocuments',
    'method' => 'GET',
    'path' => '/libraryDocuments',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocuments',
    'name' => 'Retrieves library documents for a user.',
    'description' => 'Retrieves library documents for a user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'show_hidden_library_documents' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch all the hidden library documents along with the visible library documents.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'showHiddenLibraryDocuments' => 'show_hidden_library_documents',
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_document_info',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentInfo',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocumentInfo',
    'name' => 'Retrieves the details of a library document.',
    'description' => 'Retrieves the details of a library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_audit_trail' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_document_audit_trail',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentAuditTrail',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/auditTrail',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocumentAuditTrail',
    'name' => 'Retrieves the audit trail associated with a library document.',
    'description' => 'Retrieves the audit trail associated with a library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_combined_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_combined_document',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetCombinedDocument',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/combinedDocument',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getCombinedDocument',
    'name' => 'Retrieves the combined document associated with a library document.',
    'description' => 'Retrieves the combined document associated with a library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'attach_audit_report' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to YES attach an audit report to the library document PDF. Default value will be false.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
      'attachAuditReport' => 'attach_audit_report',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_documents' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_documents',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetDocuments',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/documents',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getDocuments',
    'name' => 'Retrieves the IDs of the documents associated with library document.',
    'description' => 'Retrieves the IDs of the documents associated with library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'version_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The version identifier of library_document as provided by the API which retrieves information of a specific library document. If not provided then latest version will be used.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_library_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_document',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocument',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/documents/{documentId}',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocument',
    'name' => 'Retrieves the file stream of a document of library document.',
    'description' => 'Retrieves the file stream of a document of library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API which fetches the documents of a specified library document',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
      'documentId' => 'document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_image_urls' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_document_image_urls',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentImageUrls',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/documents/{documentId}/imageUrls',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocumentImageUrls',
    'name' => 'Retrieves image urls of all visible pages of a document associated with a library document.',
    'description' => 'Retrieves image urls of all visible pages of a document associated with a library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API which fetches the documents of a specified library document',
      ),
      'image_sizes' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of image sizes i.e. {FIXED_WIDTH_50px, FIXED_WIDTH_250px, FIXED_WIDTH_675px, ZOOM_50_PERCENT, ZOOM_75_PERCENT, ZOOM_100_PERCENT, ZOOM_125_PERCENT, ZOOM_150_PERCENT, ZOOM_200_PERCENT}. Default sizes returned are {FI...',
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
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
      'documentId' => 'document_id',
    ),
    'query_params' =>
    array (
      'imageSizes' => 'image_sizes',
      'startPage' => 'start_page',
      'endPage' => 'end_page',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_events' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_events',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetEvents',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/events',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getEvents',
    'name' => 'Retrieves the events information for a library document.',
    'description' => 'Retrieves the events information for a library document.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_note_for_api_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_get_library_document_note_for_api_user',
    'class' => 'AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentNoteForApiUser',
    'method' => 'GET',
    'path' => '/libraryDocuments/{libraryDocumentId}/me/note',
    'resource' => 'libraryDocuments',
    'operation_id' => 'getLibraryDocumentNoteForApiUser',
    'name' => 'Retrieves the latest note of a library document for the API user.',
    'description' => 'Retrieves the latest note of a library document for the API user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_library_documents_update_library_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_update_library_document',
    'class' => 'AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocument',
    'method' => 'PUT',
    'path' => '/libraryDocuments/{libraryDocumentId}',
    'resource' => 'libraryDocuments',
    'operation_id' => 'updateLibraryDocument',
    'name' => 'Updates the library document.',
    'description' => 'Currently status, name, sharingMode and templateTypes of the library document can only be updated.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the library document that you want to create.',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_library_documents_update_library_document_visibility' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_update_library_document_visibility',
    'class' => 'AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocumentVisibility',
    'method' => 'PUT',
    'path' => '/libraryDocuments/{libraryDocumentId}/me/visibility',
    'resource' => 'libraryDocuments',
    'operation_id' => 'updateLibraryDocumentVisibility',
    'name' => 'Updates the visibility of library document.',
    'description' => 'Updates the visibility of library document.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information to update visibility of agreement',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_library_documents_update_library_document_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_library_documents_update_library_document_state',
    'class' => 'AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocumentState',
    'method' => 'PUT',
    'path' => '/libraryDocuments/{libraryDocumentId}/state',
    'resource' => 'libraryDocuments',
    'operation_id' => 'updateLibraryDocumentState',
    'name' => 'Updates the library document\'s state.',
    'description' => 'Currently state can be changed from AUTHORING to ACTIVE.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'library_document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API to fetch library documents.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the state of library document to which you want to update',
      ),
    ),
    'path_params' =>
    array (
      'libraryDocumentId' => 'library_document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_mega_signs_create_mega_sign' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_create_mega_sign',
    'class' => 'AdobeAcrobatSignMegaSignsCreateMegaSign',
    'method' => 'POST',
    'path' => '/megaSigns',
    'resource' => 'megaSigns',
    'operation_id' => 'createMegaSign',
    'name' => 'Send an agreement out for signature to multiple recipients. Each recipient will receive and sign their own copy of th...',
    'description' => 'This is a primary endpoint which is used to create a new megaSign. A megaSign can be created using transientDocument, libraryDocument or a URL. You can create a megaSign in IN_PROCESS - Create a megaSign in this state to immediately send it. You can use the...',
    'type' => 'write',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_view' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_sign_view',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSignView',
    'method' => 'POST',
    'path' => '/megaSigns/{megaSignId}/views',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSignView',
    'name' => 'Retrieves the requested views of mega sign agreement.',
    'description' => 'Retrieves the requested views of mega sign agreement.',
    'type' => 'write',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_signs' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_signs',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSigns',
    'method' => 'GET',
    'path' => '/megaSigns',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSigns',
    'name' => 'Retrieves MegaSign parent agreements for a user.',
    'description' => 'Retrieves MegaSign parent agreements for a user.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_sign_info',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSignInfo',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSignInfo',
    'name' => 'Get detailed information of the specified MegaSign parent agreement.',
    'description' => 'Get detailed information of the specified MegaSign parent agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_child_agreements' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_sign_child_agreements',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSignChildAgreements',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}/agreements',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSignChildAgreements',
    'name' => 'Get all the child agreements of the specified MegaSign parent agreement.',
    'description' => 'Get all the child agreements of the specified MegaSign parent agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_child_agreements_info_file' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_child_agreements_info_file',
    'class' => 'AdobeAcrobatSignMegaSignsGetChildAgreementsInfoFile',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}/childAgreementsInfo/{childAgreementsInfoFileId}',
    'resource' => 'megaSigns',
    'operation_id' => 'getChildAgreementsInfoFile',
    'name' => 'Retrieves the file stream of the original childAgreementsInfoFile that was uploaded by sender while creating the Mega...',
    'description' => 'CSV file stream containing form data information',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
      'childAgreementsInfoFileId' => 'child_agreements_info_file_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_combined_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_sign_combined_document',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSignCombinedDocument',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}/combinedDocument',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSignCombinedDocument',
    'name' => 'Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
      'attachAuditReport' => 'attach_audit_report',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_events' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_events',
    'class' => 'AdobeAcrobatSignMegaSignsGetEvents',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}/events',
    'resource' => 'megaSigns',
    'operation_id' => 'getEvents',
    'name' => 'Retrieves the events information for the MegaSign parent agreement.',
    'description' => 'Retrieves the events information for the MegaSign parent agreement.',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_form_data' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_get_mega_sign_form_data',
    'class' => 'AdobeAcrobatSignMegaSignsGetMegaSignFormData',
    'method' => 'GET',
    'path' => '/megaSigns/{megaSignId}/formData',
    'resource' => 'megaSigns',
    'operation_id' => 'getMegaSignFormData',
    'name' => 'Retrieves data entered by recipients into interactive form fields at the time they signed the child agreements of the...',
    'description' => 'CSV file stream containing form data information',
    'type' => 'read',
    'parameters' =>
    array (
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
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_mega_signs_update_mega_sign_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_mega_signs_update_mega_sign_state',
    'class' => 'AdobeAcrobatSignMegaSignsUpdateMegaSignState',
    'method' => 'PUT',
    'path' => '/megaSigns/{megaSignId}/state',
    'resource' => 'megaSigns',
    'operation_id' => 'updateMegaSignState',
    'name' => 'Updates the state of a MegaSign identified by MegaSignId in the path.',
    'description' => 'This endpoint can be used by creator of the MegaSign to transition between the states of megaSign. An allowed transition would follow the following sequence : IN_PROCESS->CANCELLED.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
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
        'description' => 'MegaSign state update information object.',
      ),
    ),
    'path_params' =>
    array (
      'megaSignId' => 'mega_sign_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_transient_documents_create_transient_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_transient_documents_create_transient_document',
    'class' => 'AdobeAcrobatSignTransientDocumentsCreateTransientDocument',
    'method' => 'POST',
    'path' => '/transientDocuments',
    'resource' => 'transientDocuments',
    'operation_id' => 'createTransientDocument',
    'name' => 'Uploads a document and obtains the document\'s ID.',
    'description' => 'The document uploaded through this call is referred to as transient since it is available only for 7 days after the upload. The returned transient document ID can be used in the API calls where the uploaded file needs to be referred. The transient document...',
    'type' => 'write',
    'parameters' =>
    array (
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
      'file_name' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'A name for the document being uploaded. Maximum number of characters in the name is restricted to 255.',
      ),
      'mime_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The mime type of the document being uploaded. If not specified here then mime type is picked up from the file object. If mime type is not present there either then mime type is inferred from file name extension.',
      ),
      'file' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The file part of the multipart request for document upload. You can upload only one file at a time. Provide a local file path, or a string/array accepted by the host for multipart upload.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
      'File-Name' => 'file_name',
      'Mime-Type' => 'mime_type',
      'File' => 'file',
    ),
    'file_params' =>
    array (
      'File' => 'file',
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_users_get_user_views' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_get_user_views',
    'class' => 'AdobeAcrobatSignUsersGetUserViews',
    'method' => 'POST',
    'path' => '/users/{userId}/views',
    'resource' => 'users',
    'operation_id' => 'getUserViews',
    'name' => 'Retrieves the URL of manage, account settings and user profile page.',
    'description' => 'Retrieves the URL of manage, account settings and user profile page.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To get the details for the token owner, UserId can be replaced by "me" without quotes.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Name of the required view and its desired configuration.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_users_get_users' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_get_users',
    'class' => 'AdobeAcrobatSignUsersGetUsers',
    'method' => 'GET',
    'path' => '/users',
    'resource' => 'users',
    'operation_id' => 'getUsers',
    'name' => 'Retrieves all the users in an account.',
    'description' => 'Retrieves all the users in an account.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_users_get_user_detail' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_get_user_detail',
    'class' => 'AdobeAcrobatSignUsersGetUserDetail',
    'method' => 'GET',
    'path' => '/users/{userId}',
    'resource' => 'users',
    'operation_id' => 'getUserDetail',
    'name' => 'Retrieves detailed information about the user in the caller account.',
    'description' => 'Retrieves detailed information about the user in the caller account.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To get the details for the token owner, UserId can be replaced by "me" without quotes.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_users_get_groups_of_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_get_groups_of_user',
    'class' => 'AdobeAcrobatSignUsersGetGroupsOfUser',
    'method' => 'GET',
    'path' => '/users/{userId}/groups',
    'resource' => 'users',
    'operation_id' => 'getGroupsOfUser',
    'name' => 'Retrieves the groups of the user.',
    'description' => 'Retrieves the groups of the user.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To get the details for the token owner, UserId can be replaced by "me" without quotes.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_users_modify_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_modify_user',
    'class' => 'AdobeAcrobatSignUsersModifyUser',
    'method' => 'PUT',
    'path' => '/users/{userId}',
    'resource' => 'users',
    'operation_id' => 'modifyUser',
    'name' => 'Update an user.',
    'description' => 'Update an user.',
    'type' => 'write',
    'parameters' =>
    array (
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as provided by GET /users or POST /users',
      ),
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information necessary to update a user.',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_users_update_groups_of_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_update_groups_of_user',
    'class' => 'AdobeAcrobatSignUsersUpdateGroupsOfUser',
    'method' => 'PUT',
    'path' => '/users/{userId}/groups',
    'resource' => 'users',
    'operation_id' => 'updateGroupsOfUser',
    'name' => 'Updates the groups of the user.',
    'description' => 'Updates the groups of the user.',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To update the details for the token owner, UserId can be replaced by "me" without quotes.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => '',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_users_modify_user_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_users_modify_user_state',
    'class' => 'AdobeAcrobatSignUsersModifyUserState',
    'method' => 'PUT',
    'path' => '/users/{userId}/state',
    'resource' => 'users',
    'operation_id' => 'modifyUserState',
    'name' => 'Activate/Deactivate a given user.',
    'description' => 'Activate/Deactivate a given user.',
    'type' => 'write',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'user_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To update the details for the token owner, UserId can be replaced by "me" without quotes.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => '',
      ),
    ),
    'path_params' =>
    array (
      'userId' => 'user_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_webhooks_create_webhook' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_create_webhook',
    'class' => 'AdobeAcrobatSignWebhooksCreateWebhook',
    'method' => 'POST',
    'path' => '/webhooks',
    'resource' => 'webhooks',
    'operation_id' => 'createWebhook',
    'name' => 'Creates a webhook.',
    'description' => 'Creates a webhook.',
    'type' => 'write',
    'parameters' =>
    array (
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
        'description' => 'Information about the webhook that you want to create',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_webhooks_get_webhooks' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_get_webhooks',
    'class' => 'AdobeAcrobatSignWebhooksGetWebhooks',
    'method' => 'GET',
    'path' => '/webhooks',
    'resource' => 'webhooks',
    'operation_id' => 'getWebhooks',
    'name' => 'Retrieves webhooks for a user.',
    'description' => 'Retrieves webhooks for a user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'show_in_active_webhooks' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch all the inactive webhooks along with the active webhooks.',
      ),
      'scope' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'Scope of webhook. The possible values are ACCOUNT, GROUP, USER or RESOURCE',
      ),
      'resource_type' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The type of resource on which webhook was created. The possible values are AGREEMENT, WIDGET and MEGASIGN.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'showInActiveWebhooks' => 'show_in_active_webhooks',
      'scope' => 'scope',
      'resourceType' => 'resource_type',
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_webhooks_get_webhook_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_get_webhook_info',
    'class' => 'AdobeAcrobatSignWebhooksGetWebhookInfo',
    'method' => 'GET',
    'path' => '/webhooks/{webhookId}',
    'resource' => 'webhooks',
    'operation_id' => 'getWebhookInfo',
    'name' => 'Retrieves the details of a webhook.',
    'description' => 'Retrieves the details of a webhook.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'webhook_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
      ),
    ),
    'path_params' =>
    array (
      'webhookId' => 'webhook_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_webhooks_update_webhook' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_update_webhook',
    'class' => 'AdobeAcrobatSignWebhooksUpdateWebhook',
    'method' => 'PUT',
    'path' => '/webhooks/{webhookId}',
    'resource' => 'webhooks',
    'operation_id' => 'updateWebhook',
    'name' => 'Updates a webhook.',
    'description' => 'Updates a webhook.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'webhook_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information necessary to update a webhook',
      ),
    ),
    'path_params' =>
    array (
      'webhookId' => 'webhook_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_webhooks_update_webhook_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_update_webhook_state',
    'class' => 'AdobeAcrobatSignWebhooksUpdateWebhookState',
    'method' => 'PUT',
    'path' => '/webhooks/{webhookId}/state',
    'resource' => 'webhooks',
    'operation_id' => 'updateWebhookState',
    'name' => 'Updates the state of a webhook identified by webhookId in the path.',
    'description' => 'Updates the state of a webhook identified by webhookId in the path.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'webhook_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => '',
      ),
    ),
    'path_params' =>
    array (
      'webhookId' => 'webhook_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_webhooks_delete_webhook' =>
  array (
    'slug' => 'adobe_acrobat_sign_webhooks_delete_webhook',
    'class' => 'AdobeAcrobatSignWebhooksDeleteWebhook',
    'method' => 'DELETE',
    'path' => '/webhooks/{webhookId}',
    'resource' => 'webhooks',
    'operation_id' => 'deleteWebhook',
    'name' => 'Deletes a webhook.',
    'description' => 'Deletes a webhook.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'webhook_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The webhook identifier, as returned by the webhook creation API or retrieved from the API to fetch webhooks.',
      ),
    ),
    'path_params' =>
    array (
      'webhookId' => 'webhook_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_create_widget' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_create_widget',
    'class' => 'AdobeAcrobatSignWidgetsCreateWidget',
    'method' => 'POST',
    'path' => '/widgets',
    'resource' => 'widgets',
    'operation_id' => 'createWidget',
    'name' => 'Creates a widget and and returns the widgetId in the response to the client.',
    'description' => 'This is a primary endpoint which is used to create a new widget. You can create a widget in one of the 3 mentioned states: a) DRAFT - to incrementally build the widget, b) AUTHORING - to add/edit form fields in the widget, c) ACTIVE - to immediately host th...',
    'type' => 'write',
    'parameters' =>
    array (
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
        'description' => 'Information about the widget that you want to create.',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_widgets_get_widget_view' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_view',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetView',
    'method' => 'POST',
    'path' => '/widgets/{widgetId}/views',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetView',
    'name' => 'Retrieves the requested views for a widget.',
    'description' => 'Retrieves the requested views for a widget.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Name of the required view and its desired configuration.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_widgets_get_widgets' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widgets',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgets',
    'method' => 'GET',
    'path' => '/widgets',
    'resource' => 'widgets',
    'operation_id' => 'getWidgets',
    'name' => 'Retrieves widgets for a user.',
    'description' => 'Retrieves widgets for a user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'show_hidden_widgets' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch all the hidden widgets along with the visible widgets.',
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
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'showHiddenWidgets' => 'show_hidden_widgets',
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_info',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetInfo',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetInfo',
    'name' => 'Retrieves the details of a widget.',
    'description' => 'Retrieves the details of a widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_agreements' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_agreements',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetAgreements',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/agreements',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetAgreements',
    'name' => 'Retrieves agreements for the widget.',
    'description' => 'Retrieves agreements for the widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'show_hidden_agreements' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'A query parameter to fetch all the hidden agreements along with the visible agreements.',
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
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
      'showHiddenAgreements' => 'show_hidden_agreements',
      'cursor' => 'cursor',
      'pageSize' => 'page_size',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_audit_trail' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_audit_trail',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetAuditTrail',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/auditTrail',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetAuditTrail',
    'name' => 'Retrieves the audit trail of a widget identified by widgetId.',
    'description' => 'Retrieves the audit trail of a widget identified by widgetId.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_combined_document' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_combined_document',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetCombinedDocument',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/combinedDocument',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetCombinedDocument',
    'name' => 'Retrieves a single combined PDF document for the documents associated with a widget.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with a widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'version_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The version identifier of widget as provided by the API which retrieves information of a specific widget. If not provided then latest version will be used.',
      ),
      'participant_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The ID of the participant to be used to retrieve documents.',
      ),
      'attach_audit_report' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'When set to YES, attach an audit report to the signed Widget PDF. Default value is false',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
      'participantId' => 'participant_id',
      'attachAuditReport' => 'attach_audit_report',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_documents' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_documents',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetDocuments',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/documents',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetDocuments',
    'name' => 'Retrieves the IDs of the documents associated with widget.',
    'description' => 'Retrieves the IDs of the documents associated with widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'version_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The version identifier of widget as provided by the API which retrieves information of a specific widget. If not provided then latest version will be used.',
      ),
      'participant_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The ID of the participant to be used to retrieve documents.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
      'versionId' => 'version_id',
      'participantId' => 'participant_id',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_document_info' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_document_info',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetDocumentInfo',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/documents/{documentId}',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetDocumentInfo',
    'name' => 'Retrieves the file stream of a document of a widget.',
    'description' => 'Retrieves the file stream of a document of a widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'document_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The document identifier, as retrieved from the API which fetches the documents of a specified widget',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
      'documentId' => 'document_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_events' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_events',
    'class' => 'AdobeAcrobatSignWidgetsGetEvents',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/events',
    'resource' => 'widgets',
    'operation_id' => 'getEvents',
    'name' => 'Retrieves the events information for a widget.',
    'description' => 'Retrieves the events information for a widget.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_form_data' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_form_data',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetFormData',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/formData',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetFormData',
    'name' => 'Retrieves data entered by the user into interactive form fields at the time they signed the widget',
    'description' => 'CSV file stream containing form data information',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_widget_note_for_api_user' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_widget_note_for_api_user',
    'class' => 'AdobeAcrobatSignWidgetsGetWidgetNoteForApiUser',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/me/note',
    'resource' => 'widgets',
    'operation_id' => 'getWidgetNoteForApiUser',
    'name' => 'Retrieves the latest note of a widget for the API user.',
    'description' => 'Retrieves the latest note of a widget for the API user.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_all_widget_members' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_all_widget_members',
    'class' => 'AdobeAcrobatSignWidgetsGetAllWidgetMembers',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/members',
    'resource' => 'widgets',
    'operation_id' => 'getAllWidgetMembers',
    'name' => 'Retrieves detailed member info along with IDs for different types of participants.',
    'description' => 'Retrieves detailed member info along with IDs for different types of participants.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_get_participant_set' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_get_participant_set',
    'class' => 'AdobeAcrobatSignWidgetsGetParticipantSet',
    'method' => 'GET',
    'path' => '/widgets/{widgetId}/members/participantSets/{participantSetId}',
    'resource' => 'widgets',
    'operation_id' => 'getParticipantSet',
    'name' => 'Retrieves the participant set of a widget identified by widgetId in the path.',
    'description' => 'Retrieves the participant set of a widget identified by widgetId in the path.',
    'type' => 'read',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'participant_set_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The participant set identifier',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
      'participantSetId' => 'participant_set_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-None-Match' => 'if_none_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
  'adobe_acrobat_sign_widgets_update_widget' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_update_widget',
    'class' => 'AdobeAcrobatSignWidgetsUpdateWidget',
    'method' => 'PUT',
    'path' => '/widgets/{widgetId}',
    'resource' => 'widgets',
    'operation_id' => 'updateWidget',
    'name' => 'Updates a widget.',
    'description' => 'Updates a widget.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Widget update information object.',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_widgets_update_widget_visibility' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_update_widget_visibility',
    'class' => 'AdobeAcrobatSignWidgetsUpdateWidgetVisibility',
    'method' => 'PUT',
    'path' => '/widgets/{widgetId}/me/visibility',
    'resource' => 'widgets',
    'operation_id' => 'updateWidgetVisibility',
    'name' => 'Updates the visibility of widget.',
    'description' => 'Updates the visibility of widget.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => 'Information to update visibility of widget',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_widgets_update_widget_state' =>
  array (
    'slug' => 'adobe_acrobat_sign_widgets_update_widget_state',
    'class' => 'AdobeAcrobatSignWidgetsUpdateWidgetState',
    'method' => 'PUT',
    'path' => '/widgets/{widgetId}/state',
    'resource' => 'widgets',
    'operation_id' => 'updateWidgetState',
    'name' => 'Updates the state of a widget identified by widgetId in the path.',
    'description' => 'This endpoint can be used by creator of the widget to transition between the states of widget. An allowed transition would follow any of the following sequence : DRAFT->AUTHORING->ACTIVE, ACTIVEINACTIVE, DRAFT->CANCELLED.',
    'type' => 'write',
    'parameters' =>
    array (
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
      'if_match' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The server will only update the resource if it matches the listed ETag otherwise error RESOURCE_MODIFIED(412) is returned.',
      ),
      'widget_id' =>
      array (
        'type' => 'string',
        'required' => true,
        'description' => 'The widget identifier, as returned by the widget creation API or retrieved from the API to fetch widgets.',
      ),
      'body' =>
      array (
        'type' => 'object',
        'required' => true,
        'description' => '',
      ),
    ),
    'path_params' =>
    array (
      'widgetId' => 'widget_id',
    ),
    'query_params' =>
    array (
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
      'x-on-behalf-of-user' => 'x_on_behalf_of_user',
      'If-Match' => 'if_match',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => true,
  ),
  'adobe_acrobat_sign_workflows_get_workflows' =>
  array (
    'slug' => 'adobe_acrobat_sign_workflows_get_workflows',
    'class' => 'AdobeAcrobatSignWorkflowsGetWorkflows',
    'method' => 'GET',
    'path' => '/workflows',
    'resource' => 'workflows',
    'operation_id' => 'getWorkflows',
    'name' => 'Retrieves workflows for a user.',
    'description' => 'Retrieves workflows for a user.',
    'type' => 'read',
    'parameters' =>
    array (
      'x_api_user' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
      ),
      'include_draft_workflows' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Include draft workflows',
      ),
      'include_inactive_workflows' =>
      array (
        'type' => 'boolean',
        'required' => false,
        'description' => 'Include inactive workflows',
      ),
      'group_id' =>
      array (
        'type' => 'string',
        'required' => false,
        'description' => 'The group identifier for which the workflows will be fetched',
      ),
    ),
    'path_params' =>
    array (
    ),
    'query_params' =>
    array (
      'includeDraftWorkflows' => 'include_draft_workflows',
      'includeInactiveWorkflows' => 'include_inactive_workflows',
      'groupId' => 'group_id',
    ),
    'header_params' =>
    array (
      'x-api-user' => 'x_api_user',
    ),
    'form_params' =>
    array (
    ),
    'file_params' =>
    array (
    ),
    'body_required' => false,
  ),
);
    }
}
