<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Adobe Acrobat Sign.
 *
 * Exposes Adobe's published REST v6 Swagger resources for agreements, users,
 * groups, widgets, workflows, webhooks, library documents, and uploads.
 */
class AdobeAcrobatSignToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth'=>['strategy'=>'bearer_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Use an Adobe Acrobat Sign OAuth access token with scopes required by the operation.']], 'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']], 'runtime_requirements'=>[], 'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]];
    }
    public function appName(): string { return 'adobe-acrobat-sign'; }
    public function appMeta(): array { return ['label'=>'Adobe Acrobat Sign','description'=>'Electronic signature workflow administration','icon'=>'ph:signature','logo'=>'simple-icons:adobeacrobatreader']; }
    public function integrationMeta(): array { return ['name'=>'Adobe Acrobat Sign','description'=>'Manage Acrobat Sign agreements, users, groups, widgets, workflows, webhooks, library documents, and transient documents.','icon'=>'ph:signature','logo'=>'simple-icons:adobeacrobatreader','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developer.adobe.com/acrobat-sign/docs/','source_url'=>'https://github.com/adobe/acrobat-sign/tree/main/sdks/AcrobatSign_OpenAPI_SDK/json']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'api_url','type'=>'url','label'=>'REST v6 API URL','default'=>'https://api.na1.adobesign.com/api/rest/v6','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array { $token=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['api_url']??'https://api.na1.adobesign.com/api/rest/v6'),'/'); if($token==='') return ['success'=>false,'error'=>'Adobe Acrobat Sign access token is required.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/baseUris'); if(!$response->successful()) return ['success'=>false,'error'=>'Adobe Acrobat Sign API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Adobe Acrobat Sign at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'required|string','api_url'=>'nullable|url']; }
    public function credentialFields(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','required'=>true],['key'=>'api_url','type'=>'url','label'=>'REST v6 API URL','required'=>false,'default'=>'https://api.na1.adobesign.com/api/rest/v6']]; }
    public function tools(): array { return array (
  'adobe_acrobat_sign_agreements_create_agreement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsCreateAgreement',
    'type' => 'write',
    'name' => 'Creates an agreement. Sends it out for signatures, and returns the agreementID in the response to the client.',
    'description' => 'This is a primary endpoint which is used to create a new agreement. An agreement can be created using transientDocument, libraryDocument or a URL. You can create an agreement in one of the 3 mentioned states: a) DRAFT - to incrementally build the agreement...',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_add_template_fields_to_agreement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsAddTemplateFieldsToAgreement',
    'type' => 'write',
    'name' => 'Adds template fields to an agreement',
    'description' => 'Adds template fields to an agreement',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_create_delegated_participant_sets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsCreateDelegatedParticipantSets',
    'type' => 'write',
    'name' => 'Creates a participantSet to which the agreement is forwarded for taking appropriate action.',
    'description' => 'Participants marked as delegator can call this API endpoint.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_create_share_on_agreement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsCreateShareOnAgreement',
    'type' => 'write',
    'name' => 'Share an agreement with someone.',
    'description' => 'Share an agreement with someone.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_create_reminder_on_participant' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsCreateReminderOnParticipant',
    'type' => 'write',
    'name' => 'Creates a reminder on the specified participants of an agreement identified by agreementId in the path.',
    'description' => 'Creates a reminder on the specified participants of an agreement identified by agreementId in the path.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_create_agreement_view' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsCreateAgreementView',
    'type' => 'write',
    'name' => 'Retrieves the latest state view url of agreement.',
    'description' => 'Retrieves the latest state view url of agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_get_agreements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAgreements',
    'type' => 'read',
    'name' => 'Retrieves agreements for the user.',
    'description' => 'Retrieves agreements for the user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_agreement_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAgreementInfo',
    'type' => 'read',
    'name' => 'Retrieves the current status of an agreement.',
    'description' => 'Retrieves the current status of an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_audit_trail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAuditTrail',
    'type' => 'read',
    'name' => 'Retrieves the audit trail of an agreement identified by agreementId.',
    'description' => 'PDF file stream containing audit trail information',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_combined_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetCombinedDocument',
    'type' => 'read',
    'name' => 'Retrieves a single combined PDF document for the documents associated with an agreement.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_combined_document_pages_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetCombinedDocumentPagesInfo',
    'type' => 'read',
    'name' => 'Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.',
    'description' => 'Retrieves info of all pages of a combined PDF document for the documents associated with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_all_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAllDocuments',
    'type' => 'read',
    'name' => 'Retrieves the IDs of the documents of an agreement identified by agreementId.',
    'description' => 'Retrieves the IDs of the documents of an agreement identified by agreementId.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetDocument',
    'type' => 'read',
    'name' => 'Retrieves the file stream of a document of an agreement.',
    'description' => 'Retrieves the file stream of a document of an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_document_image_urls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetDocumentImageUrls',
    'type' => 'read',
    'name' => 'Retrieves image urls of all visible pages of a document associated with an agreement.',
    'description' => 'Retrieves image urls of all visible pages of a document associated with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_all_documents_image_urls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAllDocumentsImageUrls',
    'type' => 'read',
    'name' => 'Retrieves image urls of all visible pages of all the documents associated with an agreement.',
    'description' => 'Retrieves image urls of all visible pages of all the documents associated with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetEvents',
    'type' => 'read',
    'name' => 'Retrieves the events information for an agreement.',
    'description' => 'Retrieves the events information for an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_form_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetFormData',
    'type' => 'read',
    'name' => 'Retrieves data entered into the interactive form fields of the agreement.',
    'description' => 'This API can only be called by the creator of the agreement',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_form_fields' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetFormFields',
    'type' => 'read',
    'name' => 'Retrieves details of form fields of an agreement.',
    'description' => 'Retrieves details of form fields of an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_merge_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetMergeInfo',
    'type' => 'read',
    'name' => 'Retrieves the merge info stored with an agreement.',
    'description' => 'Retrieves the merge info stored with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_agreement_note_for_api_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAgreementNoteForApiUser',
    'type' => 'read',
    'name' => 'Retrieves the latest note associated with an agreement.',
    'description' => 'Retrieves the latest note associated with an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_all_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAllMembers',
    'type' => 'read',
    'name' => 'Retrieves information of members of the agreement.',
    'description' => 'Retrieves information of members of the agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_participant_set' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetParticipantSet',
    'type' => 'read',
    'name' => 'Retrieves the participant set of an agreement identified by agreementId in the path.',
    'description' => 'Retrieves the participant set of an agreement identified by agreementId in the path.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_signing_url' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetSigningUrl',
    'type' => 'read',
    'name' => 'Retrieves the URL for the e-sign page for the current signer(s) of an agreement.',
    'description' => 'Retrieves the URL for the e-sign page for the current signer(s) of an agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_get_agreement_reminders' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsGetAgreementReminders',
    'type' => 'read',
    'name' => 'Retrieves the reminders of an agreement, identified by agreementId in the path.',
    'description' => 'Retrieves the reminders of an agreement, identified by agreementId in the path.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_agreements_update_agreement' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateAgreement',
    'type' => 'write',
    'name' => 'Updates the agreement in draft state.',
    'description' => 'Updates the agreement in draft state.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_update_form_fields' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateFormFields',
    'type' => 'write',
    'name' => 'Updates form fields of an agreement.',
    'description' => 'Updates form fields of an agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_update_agreement_merge_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateAgreementMergeInfo',
    'type' => 'write',
    'name' => 'Set the merge info for an agreement.',
    'description' => 'Set the merge info for an agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_update_agreement_visibility' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateAgreementVisibility',
    'type' => 'write',
    'name' => 'Updates the visibility of an agreement.',
    'description' => 'Updates the visibility of an agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_update_participant_set' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateParticipantSet',
    'type' => 'write',
    'name' => 'Updates the participant set of an agreement identified by agreementId in the path.',
    'description' => 'Updates the participant set of an agreement identified by agreementId in the path.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_reject_agreement_for_participation' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsRejectAgreementForParticipation',
    'type' => 'write',
    'name' => 'Rejects the agreement for a participant.',
    'description' => 'Rejects the agreement for a participant.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_update_agreement_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsUpdateAgreementState',
    'type' => 'write',
    'name' => 'Updates the state of an agreement identified by agreementId in the path.',
    'description' => 'This endpoint can be used by originator/sender of an agreement to transition between the states of agreement. An allowed transition would follow the following sequence: DRAFT -> AUTHORING -> IN_PROCESS -> CANCELLED.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_agreements_delete_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignAgreementsDeleteDocuments',
    'type' => 'write',
    'name' => 'Deletes all the documents of an agreement.',
    'description' => 'Deletes all the documents of an agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_base_uris_get_base_uris' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignBaseUrisGetBaseUris',
    'type' => 'read',
    'name' => 'Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be consid...',
    'description' => 'Gets the base uri to access other APIs. In case other APIs are accessed from a different end point, it will be considered an invalid request.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_groups_get_groups' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignGroupsGetGroups',
    'type' => 'read',
    'name' => 'Retrieves all the groups in an account.',
    'description' => 'Retrieves all the groups in an account.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_groups_get_group_details' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignGroupsGetGroupDetails',
    'type' => 'read',
    'name' => 'Retrieves detailed information about the group.',
    'description' => 'Retrieves detailed information about the group.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_groups_get_users_in_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignGroupsGetUsersInGroup',
    'type' => 'read',
    'name' => 'Retrieves all the users in a group.',
    'description' => 'Retrieves all the users in a group.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_create_library_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsCreateLibraryDocument',
    'type' => 'write',
    'name' => 'Creates a template that is placed in the library of the user for reuse.',
    'description' => 'Creates a template that is placed in the library of the user for reuse.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_library_documents_create_library_document_view' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsCreateLibraryDocumentView',
    'type' => 'write',
    'name' => 'Retrieves the latest state view url of a library document.',
    'description' => 'Retrieves the latest state view url of a library document.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_library_documents_get_library_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocuments',
    'type' => 'read',
    'name' => 'Retrieves library documents for a user.',
    'description' => 'Retrieves library documents for a user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentInfo',
    'type' => 'read',
    'name' => 'Retrieves the details of a library document.',
    'description' => 'Retrieves the details of a library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_audit_trail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentAuditTrail',
    'type' => 'read',
    'name' => 'Retrieves the audit trail associated with a library document.',
    'description' => 'Retrieves the audit trail associated with a library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_combined_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetCombinedDocument',
    'type' => 'read',
    'name' => 'Retrieves the combined document associated with a library document.',
    'description' => 'Retrieves the combined document associated with a library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetDocuments',
    'type' => 'read',
    'name' => 'Retrieves the IDs of the documents associated with library document.',
    'description' => 'Retrieves the IDs of the documents associated with library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_library_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocument',
    'type' => 'read',
    'name' => 'Retrieves the file stream of a document of library document.',
    'description' => 'Retrieves the file stream of a document of library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_image_urls' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentImageUrls',
    'type' => 'read',
    'name' => 'Retrieves image urls of all visible pages of a document associated with a library document.',
    'description' => 'Retrieves image urls of all visible pages of a document associated with a library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetEvents',
    'type' => 'read',
    'name' => 'Retrieves the events information for a library document.',
    'description' => 'Retrieves the events information for a library document.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_get_library_document_note_for_api_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsGetLibraryDocumentNoteForApiUser',
    'type' => 'read',
    'name' => 'Retrieves the latest note of a library document for the API user.',
    'description' => 'Retrieves the latest note of a library document for the API user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_library_documents_update_library_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocument',
    'type' => 'write',
    'name' => 'Updates the library document.',
    'description' => 'Currently status, name, sharingMode and templateTypes of the library document can only be updated.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_library_documents_update_library_document_visibility' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocumentVisibility',
    'type' => 'write',
    'name' => 'Updates the visibility of library document.',
    'description' => 'Updates the visibility of library document.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_library_documents_update_library_document_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignLibraryDocumentsUpdateLibraryDocumentState',
    'type' => 'write',
    'name' => 'Updates the library document\'s state.',
    'description' => 'Currently state can be changed from AUTHORING to ACTIVE.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_mega_signs_create_mega_sign' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsCreateMegaSign',
    'type' => 'write',
    'name' => 'Send an agreement out for signature to multiple recipients. Each recipient will receive and sign their own copy of th...',
    'description' => 'This is a primary endpoint which is used to create a new megaSign. A megaSign can be created using transientDocument, libraryDocument or a URL. You can create a megaSign in IN_PROCESS - Create a megaSign in this state to immediately send it. You can use the...',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_view' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSignView',
    'type' => 'write',
    'name' => 'Retrieves the requested views of mega sign agreement.',
    'description' => 'Retrieves the requested views of mega sign agreement.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_signs' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSigns',
    'type' => 'read',
    'name' => 'Retrieves MegaSign parent agreements for a user.',
    'description' => 'Retrieves MegaSign parent agreements for a user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSignInfo',
    'type' => 'read',
    'name' => 'Get detailed information of the specified MegaSign parent agreement.',
    'description' => 'Get detailed information of the specified MegaSign parent agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_child_agreements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSignChildAgreements',
    'type' => 'read',
    'name' => 'Get all the child agreements of the specified MegaSign parent agreement.',
    'description' => 'Get all the child agreements of the specified MegaSign parent agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_child_agreements_info_file' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetChildAgreementsInfoFile',
    'type' => 'read',
    'name' => 'Retrieves the file stream of the original childAgreementsInfoFile that was uploaded by sender while creating the Mega...',
    'description' => 'CSV file stream containing form data information',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_combined_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSignCombinedDocument',
    'type' => 'read',
    'name' => 'Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with the MegaSign parent agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetEvents',
    'type' => 'read',
    'name' => 'Retrieves the events information for the MegaSign parent agreement.',
    'description' => 'Retrieves the events information for the MegaSign parent agreement.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_get_mega_sign_form_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsGetMegaSignFormData',
    'type' => 'read',
    'name' => 'Retrieves data entered by recipients into interactive form fields at the time they signed the child agreements of the...',
    'description' => 'CSV file stream containing form data information',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_mega_signs_update_mega_sign_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignMegaSignsUpdateMegaSignState',
    'type' => 'write',
    'name' => 'Updates the state of a MegaSign identified by MegaSignId in the path.',
    'description' => 'This endpoint can be used by creator of the MegaSign to transition between the states of megaSign. An allowed transition would follow the following sequence : IN_PROCESS->CANCELLED.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_transient_documents_create_transient_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignTransientDocumentsCreateTransientDocument',
    'type' => 'write',
    'name' => 'Uploads a document and obtains the document\'s ID.',
    'description' => 'The document uploaded through this call is referred to as transient since it is available only for 7 days after the upload. The returned transient document ID can be used in the API calls where the uploaded file needs to be referred. The transient document...',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_users_get_user_views' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersGetUserViews',
    'type' => 'write',
    'name' => 'Retrieves the URL of manage, account settings and user profile page.',
    'description' => 'Retrieves the URL of manage, account settings and user profile page.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_users_get_users' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersGetUsers',
    'type' => 'read',
    'name' => 'Retrieves all the users in an account.',
    'description' => 'Retrieves all the users in an account.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_users_get_user_detail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersGetUserDetail',
    'type' => 'read',
    'name' => 'Retrieves detailed information about the user in the caller account.',
    'description' => 'Retrieves detailed information about the user in the caller account.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_users_get_groups_of_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersGetGroupsOfUser',
    'type' => 'read',
    'name' => 'Retrieves the groups of the user.',
    'description' => 'Retrieves the groups of the user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_users_modify_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersModifyUser',
    'type' => 'write',
    'name' => 'Update an user.',
    'description' => 'Update an user.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_users_update_groups_of_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersUpdateGroupsOfUser',
    'type' => 'write',
    'name' => 'Updates the groups of the user.',
    'description' => 'Updates the groups of the user.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_users_modify_user_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignUsersModifyUserState',
    'type' => 'write',
    'name' => 'Activate/Deactivate a given user.',
    'description' => 'Activate/Deactivate a given user.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_webhooks_create_webhook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksCreateWebhook',
    'type' => 'write',
    'name' => 'Creates a webhook.',
    'description' => 'Creates a webhook.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_webhooks_get_webhooks' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksGetWebhooks',
    'type' => 'read',
    'name' => 'Retrieves webhooks for a user.',
    'description' => 'Retrieves webhooks for a user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_webhooks_get_webhook_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksGetWebhookInfo',
    'type' => 'read',
    'name' => 'Retrieves the details of a webhook.',
    'description' => 'Retrieves the details of a webhook.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_webhooks_update_webhook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksUpdateWebhook',
    'type' => 'write',
    'name' => 'Updates a webhook.',
    'description' => 'Updates a webhook.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_webhooks_update_webhook_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksUpdateWebhookState',
    'type' => 'write',
    'name' => 'Updates the state of a webhook identified by webhookId in the path.',
    'description' => 'Updates the state of a webhook identified by webhookId in the path.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_webhooks_delete_webhook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWebhooksDeleteWebhook',
    'type' => 'write',
    'name' => 'Deletes a webhook.',
    'description' => 'Deletes a webhook.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_widgets_create_widget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsCreateWidget',
    'type' => 'write',
    'name' => 'Creates a widget and and returns the widgetId in the response to the client.',
    'description' => 'This is a primary endpoint which is used to create a new widget. You can create a widget in one of the 3 mentioned states: a) DRAFT - to incrementally build the widget, b) AUTHORING - to add/edit form fields in the widget, c) ACTIVE - to immediately host th...',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_widgets_get_widget_view' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetView',
    'type' => 'write',
    'name' => 'Retrieves the requested views for a widget.',
    'description' => 'Retrieves the requested views for a widget.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_widgets_get_widgets' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgets',
    'type' => 'read',
    'name' => 'Retrieves widgets for a user.',
    'description' => 'Retrieves widgets for a user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetInfo',
    'type' => 'read',
    'name' => 'Retrieves the details of a widget.',
    'description' => 'Retrieves the details of a widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_agreements' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetAgreements',
    'type' => 'read',
    'name' => 'Retrieves agreements for the widget.',
    'description' => 'Retrieves agreements for the widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_audit_trail' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetAuditTrail',
    'type' => 'read',
    'name' => 'Retrieves the audit trail of a widget identified by widgetId.',
    'description' => 'Retrieves the audit trail of a widget identified by widgetId.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_combined_document' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetCombinedDocument',
    'type' => 'read',
    'name' => 'Retrieves a single combined PDF document for the documents associated with a widget.',
    'description' => 'Retrieves a single combined PDF document for the documents associated with a widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_documents' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetDocuments',
    'type' => 'read',
    'name' => 'Retrieves the IDs of the documents associated with widget.',
    'description' => 'Retrieves the IDs of the documents associated with widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_document_info' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetDocumentInfo',
    'type' => 'read',
    'name' => 'Retrieves the file stream of a document of a widget.',
    'description' => 'Retrieves the file stream of a document of a widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_events' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetEvents',
    'type' => 'read',
    'name' => 'Retrieves the events information for a widget.',
    'description' => 'Retrieves the events information for a widget.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_form_data' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetFormData',
    'type' => 'read',
    'name' => 'Retrieves data entered by the user into interactive form fields at the time they signed the widget',
    'description' => 'CSV file stream containing form data information',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_widget_note_for_api_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetWidgetNoteForApiUser',
    'type' => 'read',
    'name' => 'Retrieves the latest note of a widget for the API user.',
    'description' => 'Retrieves the latest note of a widget for the API user.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_all_widget_members' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetAllWidgetMembers',
    'type' => 'read',
    'name' => 'Retrieves detailed member info along with IDs for different types of participants.',
    'description' => 'Retrieves detailed member info along with IDs for different types of participants.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_get_participant_set' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsGetParticipantSet',
    'type' => 'read',
    'name' => 'Retrieves the participant set of a widget identified by widgetId in the path.',
    'description' => 'Retrieves the participant set of a widget identified by widgetId in the path.',
    'icon' => 'ph:file-text',
  ),
  'adobe_acrobat_sign_widgets_update_widget' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsUpdateWidget',
    'type' => 'write',
    'name' => 'Updates a widget.',
    'description' => 'Updates a widget.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_widgets_update_widget_visibility' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsUpdateWidgetVisibility',
    'type' => 'write',
    'name' => 'Updates the visibility of widget.',
    'description' => 'Updates the visibility of widget.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_widgets_update_widget_state' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWidgetsUpdateWidgetState',
    'type' => 'write',
    'name' => 'Updates the state of a widget identified by widgetId in the path.',
    'description' => 'This endpoint can be used by creator of the widget to transition between the states of widget. An allowed transition would follow any of the following sequence : DRAFT->AUTHORING->ACTIVE, ACTIVEINACTIVE, DRAFT->CANCELLED.',
    'icon' => 'ph:pencil-simple',
  ),
  'adobe_acrobat_sign_workflows_get_workflows' =>
  array (
    'class' => 'OpenCompany\\Integrations\\AdobeAcrobatSign\\Tools\\AdobeAcrobatSignWorkflowsGetWorkflows',
    'type' => 'read',
    'name' => 'Retrieves workflows for a user.',
    'description' => 'Retrieves workflows for a user.',
    'icon' => 'ph:file-text',
  ),
); }
    public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/adobe-acrobat-sign.md'; }
    public function isIntegration(): bool { return true; }
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime context from the host. */
    private function resolveService(array $context = []): AdobeAcrobatSignService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new AdobeAcrobatSignService(accessToken:$creds->get('adobe-acrobat-sign','access_token','',$account), baseUrl:$creds->get('adobe-acrobat-sign','api_url','https://api.na1.adobesign.com/api/rest/v6',$account));} return app(AdobeAcrobatSignService::class); }
}
