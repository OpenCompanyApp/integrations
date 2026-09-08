<?php

namespace OpenCompany\Integrations\GoogleContacts;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Contacts.
 *
 * Exposes generated coverage for the official People API Discovery document,
 * including people, connections, other contacts, contact groups, and photos.
 */
class GoogleContactsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with People API contact scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-contacts'; }
    public function appMeta(): array { return ['label'=>'Google Contacts','description'=>'People, connections, other contacts, contact groups, members, and photos','icon'=>'ph:address-book','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Contacts','description'=>'Generated coverage for the Google People API v1: people, connections, other contacts, contact groups, members, and photos.','icon'=>'ph:address-book','logo'=>'logos:google-icon','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developers.google.com/people/api/rest']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with People API scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://people.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://people.googleapis.com']]; }
    /**
     * Verify Google Contacts credentials with a lightweight contact groups call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://people.googleapis.com'),'/'); if($accessToken==='') return ['success'=>false,'error'=>'No access token provided.']; try{$response=Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/v1/contactGroups', ['pageSize'=>1]); return $response->successful()?['success'=>true,'message'=>'Google Contacts credentials verified.']:['success'=>false,'error'=>'Google Contacts API returned HTTP '.$response->status().'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_contacts_people_search_directory_people' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleSearchDirectoryPeople',
  'type' => 'read',
  'name' => 'People Search Directory People',
  'description' => 'People Search Directory People (GET /v1/people:searchDirectoryPeople).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_people_delete_contact_photo' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleDeleteContactPhoto',
  'type' => 'write',
  'name' => 'People Delete Contact Photo',
  'description' => 'People Delete Contact Photo (DELETE /v1/{+resourceName}:deleteContactPhoto).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_batch_delete_contacts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleBatchDeleteContacts',
  'type' => 'write',
  'name' => 'People Batch Delete Contacts',
  'description' => 'People Batch Delete Contacts (POST /v1/people:batchDeleteContacts).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_create_contact' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleCreateContact',
  'type' => 'write',
  'name' => 'People Create Contact',
  'description' => 'People Create Contact (POST /v1/people:createContact).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_list_directory_people' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleListDirectoryPeople',
  'type' => 'read',
  'name' => 'People List Directory People',
  'description' => 'People List Directory People (GET /v1/people:listDirectoryPeople).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_people_update_contact' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleUpdateContact',
  'type' => 'write',
  'name' => 'People Update Contact',
  'description' => 'People Update Contact (PATCH /v1/{+resourceName}:updateContact).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_update_contact_photo' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleUpdateContactPhoto',
  'type' => 'write',
  'name' => 'People Update Contact Photo',
  'description' => 'People Update Contact Photo (PATCH /v1/{+resourceName}:updateContactPhoto).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleGet',
  'type' => 'read',
  'name' => 'People Get',
  'description' => 'People Get (GET /v1/{+resourceName}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_people_delete_contact' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleDeleteContact',
  'type' => 'write',
  'name' => 'People Delete Contact',
  'description' => 'People Delete Contact (DELETE /v1/{+resourceName}:deleteContact).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_get_batch_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleGetBatchGet',
  'type' => 'read',
  'name' => 'People Get Batch Get',
  'description' => 'People Get Batch Get (GET /v1/people:batchGet).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_people_batch_update_contacts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleBatchUpdateContacts',
  'type' => 'write',
  'name' => 'People Batch Update Contacts',
  'description' => 'People Batch Update Contacts (POST /v1/people:batchUpdateContacts).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_search_contacts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleSearchContacts',
  'type' => 'read',
  'name' => 'People Search Contacts',
  'description' => 'People Search Contacts (GET /v1/people:searchContacts).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_people_batch_create_contacts' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleBatchCreateContacts',
  'type' => 'write',
  'name' => 'People Batch Create Contacts',
  'description' => 'People Batch Create Contacts (POST /v1/people:batchCreateContacts).',
  'icon' => 'ph:address-book',
),
        'google_contacts_people_connections_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsPeopleConnectionsList',
  'type' => 'read',
  'name' => 'People Connections List',
  'description' => 'People Connections List (GET /v1/{+resourceName}/connections).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_other_contacts_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsOtherContactsList',
  'type' => 'read',
  'name' => 'Other Contacts List',
  'description' => 'Other Contacts List (GET /v1/otherContacts).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_other_contacts_search' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsOtherContactsSearch',
  'type' => 'read',
  'name' => 'Other Contacts Search',
  'description' => 'Other Contacts Search (GET /v1/otherContacts:search).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_other_contacts_copy_other_contact_to_my_contacts_group' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsOtherContactsCopyOtherContactToMyContactsGroup',
  'type' => 'write',
  'name' => 'Other Contacts Copy Other Contact To My Contacts Group',
  'description' => 'Other Contacts Copy Other Contact To My Contacts Group (POST /v1/{+resourceName}:copyOtherContactToMyContactsGroup).',
  'icon' => 'ph:address-book',
),
        'google_contacts_contact_groups_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsCreate',
  'type' => 'write',
  'name' => 'Contact Groups Create',
  'description' => 'Contact Groups Create (POST /v1/contactGroups).',
  'icon' => 'ph:address-book',
),
        'google_contacts_contact_groups_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsGet',
  'type' => 'read',
  'name' => 'Contact Groups Get',
  'description' => 'Contact Groups Get (GET /v1/{+resourceName}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_contact_groups_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsList',
  'type' => 'read',
  'name' => 'Contact Groups List',
  'description' => 'Contact Groups List (GET /v1/contactGroups).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_contact_groups_batch_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsBatchGet',
  'type' => 'read',
  'name' => 'Contact Groups Batch Get',
  'description' => 'Contact Groups Batch Get (GET /v1/contactGroups:batchGet).',
  'icon' => 'ph:magnifying-glass',
),
        'google_contacts_contact_groups_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsUpdate',
  'type' => 'write',
  'name' => 'Contact Groups Update',
  'description' => 'Contact Groups Update (PUT /v1/{+resourceName}).',
  'icon' => 'ph:address-book',
),
        'google_contacts_contact_groups_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsDelete',
  'type' => 'write',
  'name' => 'Contact Groups Delete',
  'description' => 'Contact Groups Delete (DELETE /v1/{+resourceName}).',
  'icon' => 'ph:address-book',
),
        'google_contacts_contact_groups_members_modify' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleContacts\\Tools\\GoogleContactsContactGroupsMembersModify',
  'type' => 'write',
  'name' => 'Contact Groups Members Modify',
  'description' => 'Contact Groups Members Modify (POST /v1/{+resourceName}/members:modify).',
  'icon' => 'ph:address-book',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleContactsService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleContactsService(accessToken: $creds->get('google-contacts','access_token','',$account), baseUrl: $creds->get('google-contacts','url','https://people.googleapis.com',$account));} return app(GoogleContactsService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-contacts.md'; }
}
