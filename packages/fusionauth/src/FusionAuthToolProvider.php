<?php

namespace OpenCompany\Integrations\FusionAuth;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for FusionAuth.
 *
 * Exposes the official FusionAuth OpenAPI operation set for users, applications,
 * tenants, API keys, registrations, groups, identity providers, lambdas, themes, and webhooks.
 */
class FusionAuthToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_key_header','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['FusionAuth API keys are sent in the Authorization header. Use tenant_id for X-FusionAuth-TenantId when needed.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'fusionauth'; } public function appMeta(): array { return ['label'=>'FusionAuth','description'=>'Customer identity and access management','icon'=>'ph:key','logo'=>'simple-icons:fusionauth']; }
    public function integrationMeta(): array { return ['name'=>'FusionAuth','description'=>'Manage FusionAuth users, applications, tenants, registrations, API keys, groups, identity providers, lambdas, themes, webhooks, reports, and system operations.','icon'=>'ph:key','logo'=>'simple-icons:fusionauth','category'=>'productivity','badge'=>'verified','docs_url'=>'https://fusionauth.io/docs/apis/','source_url'=>'https://raw.githubusercontent.com/FusionAuth/fusionauth-openapi/main/openapi.yaml']; }
    public function configSchema(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true],['key'=>'base_url','type'=>'url','label'=>'FusionAuth Base URL','default'=>'https://fusionauth.example.test','required'=>true],['key'=>'tenant_id','type'=>'text','label'=>'Default Tenant ID','required'=>false]]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $key=(string)($config['api_key']??''); $baseUrl=rtrim((string)($config['base_url']??'https://fusionauth.example.test'),'/'); if($key==='') return ['success'=>false,'error'=>'FusionAuth API key is required.']; try{$response=Http::withHeaders(['Authorization'=>$key,'Accept'=>'application/json'])->timeout(10)->get($baseUrl.'/api/status'); if(!$response->successful()) return ['success'=>false,'error'=>'FusionAuth API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to FusionAuth at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['api_key'=>'required|string','base_url'=>'required|url','tenant_id'=>'nullable|string']; } public function credentialFields(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','required'=>true],['key'=>'base_url','type'=>'url','label'=>'FusionAuth Base URL','required'=>true,'default'=>'https://fusionauth.example.test'],['key'=>'tenant_id','type'=>'string','label'=>'Default Tenant ID','required'=>false]]; }
    public function tools(): array { return array (
  'fusionauth_action_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthActionUserWithId',
    'type' => 'write',
    'name' => 'action User With Id',
    'description' => 'Takes an action on a user. The user being actioned is called the "actionee" and the user taking the action is called the "actioner". Both user ids are required in the request object.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_activate_reactor_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthActivateReactorWithId',
    'type' => 'write',
    'name' => 'activate Reactor With Id',
    'description' => 'Activates the FusionAuth Reactor using a license Id and optionally a license text (for air-gapped deployments)',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_cancel_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCancelActionWithId',
    'type' => 'write',
    'name' => 'cancel Action With Id',
    'description' => 'Cancels the user action.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_change_password_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthChangePasswordWithId',
    'type' => 'write',
    'name' => 'change Password With Id',
    'description' => 'Changes a user\'s password using the change password Id. This usually occurs after an email has been sent to the user and they clicked on a link to reset their password. As of version 1.32.2, prefer sending the changePasswordId in the request body. To do this, omit the first parameter, and set the value in the request body.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_comment_on_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCommentOnUserWithId',
    'type' => 'write',
    'name' => 'comment On User With Id',
    'description' => 'Adds a comment to the user\'s account.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_complete_verify_identity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCompleteVerifyIdentityWithId',
    'type' => 'write',
    'name' => 'complete Verify Identity With Id',
    'description' => 'Completes verification of an identity using verification codes from the Verify Start API.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_complete_web_authn_assertion_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCompleteWebAuthnAssertionWithId',
    'type' => 'write',
    'name' => 'complete Web Authn Assertion With Id',
    'description' => 'Complete a WebAuthn authentication ceremony by validating the signature against the previously generated challenge without logging the user in',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_complete_web_authn_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCompleteWebAuthnLoginWithId',
    'type' => 'write',
    'name' => 'complete Web Authn Login With Id',
    'description' => 'Complete a WebAuthn authentication ceremony by validating the signature against the previously generated challenge and then login the user in',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_complete_web_authn_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCompleteWebAuthnRegistrationWithId',
    'type' => 'write',
    'name' => 'complete Web Authn Registration With Id',
    'description' => 'Complete a WebAuthn registration ceremony by validating the client request and saving the new credential',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_apikey' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApikey',
    'type' => 'write',
    'name' => 'create APIKey',
    'description' => 'Creates an API key. You can optionally specify a unique Id for the key, if not provided one will be generated. an API key can only be created with equal or lesser authority. An API key cannot create another API key unless it is granted to that API key. If an API key is locked to a tenant, it can only create API Keys for that same tenant.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_apikey_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApikeyWithId',
    'type' => 'write',
    'name' => 'create APIKey With Id',
    'description' => 'Creates an API key. You can optionally specify a unique Id for the key, if not provided one will be generated. an API key can only be created with equal or lesser authority. An API key cannot create another API key unless it is granted to that API key. If an API key is locked to a tenant, it can only create API Keys for that same tenant.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApplication',
    'type' => 'write',
    'name' => 'create Application',
    'description' => 'Creates an application. You can optionally specify an Id for the application, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_application_role' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApplicationRole',
    'type' => 'write',
    'name' => 'create Application Role',
    'description' => 'Creates a new role for an application. You must specify the Id of the application you are creating the role for. You can optionally specify an Id for the role inside the ApplicationRole object itself, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_application_role_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApplicationRoleWithId',
    'type' => 'write',
    'name' => 'create Application Role With Id',
    'description' => 'Creates a new role for an application. You must specify the Id of the application you are creating the role for. You can optionally specify an Id for the role inside the ApplicationRole object itself, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_application_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateApplicationWithId',
    'type' => 'write',
    'name' => 'create Application With Id',
    'description' => 'Creates an application. You can optionally specify an Id for the application, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_audit_log_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateAuditLogWithId',
    'type' => 'write',
    'name' => 'create Audit Log With Id',
    'description' => 'Creates an audit log with the message and user name (usually an email). Audit logs should be written anytime you make changes to the FusionAuth database. When using the FusionAuth App web interface, any changes are automatically written to the audit log. However, if you are accessing the API, you must write the audit logs yourself.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_connector' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateConnector',
    'type' => 'write',
    'name' => 'create Connector',
    'description' => 'Creates a connector. You can optionally specify an Id for the connector, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_connector_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateConnectorWithId',
    'type' => 'write',
    'name' => 'create Connector With Id',
    'description' => 'Creates a connector. You can optionally specify an Id for the connector, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_consent' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateConsent',
    'type' => 'write',
    'name' => 'create Consent',
    'description' => 'Creates a user consent type. You can optionally specify an Id for the consent type, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateConsentWithId',
    'type' => 'write',
    'name' => 'create Consent With Id',
    'description' => 'Creates a user consent type. You can optionally specify an Id for the consent type, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_device_approve' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateDeviceApprove',
    'type' => 'write',
    'name' => 'create Device Approve',
    'description' => 'Approve a device grant. OR Approve a device grant.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_device_authorize' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateDeviceAuthorize',
    'type' => 'write',
    'name' => 'create Device_authorize',
    'description' => 'Start the Device Authorization flow using a request body OR Start the Device Authorization flow using form-encoded parameters',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_device_user_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateDeviceUserCode',
    'type' => 'write',
    'name' => 'create Device User Code',
    'description' => 'Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. OR Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. This request will require an API key.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_email_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEmailTemplate',
    'type' => 'write',
    'name' => 'create Email Template',
    'description' => 'Creates an email template. You can optionally specify an Id for the template, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_email_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEmailTemplateWithId',
    'type' => 'write',
    'name' => 'create Email Template With Id',
    'description' => 'Creates an email template. You can optionally specify an Id for the template, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntity',
    'type' => 'write',
    'name' => 'create Entity',
    'description' => 'Creates an Entity. You can optionally specify an Id for the Entity. If not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity_type' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntityType',
    'type' => 'write',
    'name' => 'create Entity Type',
    'description' => 'Creates a Entity Type. You can optionally specify an Id for the Entity Type, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity_type_permission' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntityTypePermission',
    'type' => 'write',
    'name' => 'create Entity Type Permission',
    'description' => 'Creates a new permission for an entity type. You must specify the Id of the entity type you are creating the permission for. You can optionally specify an Id for the permission inside the EntityTypePermission object itself, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity_type_permission_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntityTypePermissionWithId',
    'type' => 'write',
    'name' => 'create Entity Type Permission With Id',
    'description' => 'Creates a new permission for an entity type. You must specify the Id of the entity type you are creating the permission for. You can optionally specify an Id for the permission inside the EntityTypePermission object itself, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntityTypeWithId',
    'type' => 'write',
    'name' => 'create Entity Type With Id',
    'description' => 'Creates a Entity Type. You can optionally specify an Id for the Entity Type, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_entity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateEntityWithId',
    'type' => 'write',
    'name' => 'create Entity With Id',
    'description' => 'Creates an Entity. You can optionally specify an Id for the Entity. If not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_family' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateFamily',
    'type' => 'write',
    'name' => 'create Family',
    'description' => 'Creates a family with the user Id in the request as the owner and sole member of the family. You can optionally specify an Id for the family, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_family_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateFamilyWithId',
    'type' => 'write',
    'name' => 'create Family With Id',
    'description' => 'Creates a family with the user Id in the request as the owner and sole member of the family. You can optionally specify an Id for the family, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_form' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateForm',
    'type' => 'write',
    'name' => 'create Form',
    'description' => 'Creates a form. You can optionally specify an Id for the form, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_form_field' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateFormField',
    'type' => 'write',
    'name' => 'create Form Field',
    'description' => 'Creates a form field. You can optionally specify an Id for the form, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_form_field_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateFormFieldWithId',
    'type' => 'write',
    'name' => 'create Form Field With Id',
    'description' => 'Creates a form field. You can optionally specify an Id for the form, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_form_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateFormWithId',
    'type' => 'write',
    'name' => 'create Form With Id',
    'description' => 'Creates a form. You can optionally specify an Id for the form, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_group' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateGroup',
    'type' => 'write',
    'name' => 'create Group',
    'description' => 'Creates a group. You can optionally specify an Id for the group, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_group_members_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateGroupMembersWithId',
    'type' => 'write',
    'name' => 'create Group Members With Id',
    'description' => 'Creates a member in a group.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_group_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateGroupWithId',
    'type' => 'write',
    'name' => 'create Group With Id',
    'description' => 'Creates a group. You can optionally specify an Id for the group, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_identity_provider' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateIdentityProvider',
    'type' => 'write',
    'name' => 'create Identity Provider',
    'description' => 'Creates an identity provider. You can optionally specify an Id for the identity provider, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_identity_provider_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateIdentityProviderWithId',
    'type' => 'write',
    'name' => 'create Identity Provider With Id',
    'description' => 'Creates an identity provider. You can optionally specify an Id for the identity provider, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_introspect' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateIntrospect',
    'type' => 'write',
    'name' => 'create Introspect',
    'description' => 'Inspect an access token issued as the result of the Client Credentials Grant. OR Inspect an access token issued as the result of the Client Credentials Grant. OR Inspect an access token issued as the result of the User based grant such as the Authorization Code Grant, Implicit Grant, the User Credentials Grant or the Refresh Grant. OR Inspect an access token issued as the result of the User based grant such as the Authorization Code Grant, Implicit Grant, the User Credentials Grant or the Refres',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_ipaccess_control_list' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateIpaccessControlList',
    'type' => 'write',
    'name' => 'create IPAccess Control List',
    'description' => 'Creates an IP Access Control List. You can optionally specify an Id on this create request, if one is not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_ipaccess_control_list_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateIpaccessControlListWithId',
    'type' => 'write',
    'name' => 'create IPAccess Control List With Id',
    'description' => 'Creates an IP Access Control List. You can optionally specify an Id on this create request, if one is not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_lambda' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateLambda',
    'type' => 'write',
    'name' => 'create Lambda',
    'description' => 'Creates a Lambda. You can optionally specify an Id for the lambda, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_lambda_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateLambdaWithId',
    'type' => 'write',
    'name' => 'create Lambda With Id',
    'description' => 'Creates a Lambda. You can optionally specify an Id for the lambda, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_logout' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateLogout',
    'type' => 'write',
    'name' => 'create Logout',
    'description' => 'The Logout API is intended to be used to remove the refresh token and access token cookies if they exist on the client and revoke the refresh token stored. This API takes the refresh token in the JSON body. OR The Logout API is intended to be used to remove the refresh token and access token cookies if they exist on the client and revoke the refresh token stored. This API does nothing if the request does not contain an access token or refresh token cookies.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_message_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateMessageTemplate',
    'type' => 'write',
    'name' => 'create Message Template',
    'description' => 'Creates an message template. You can optionally specify an Id for the template, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_message_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateMessageTemplateWithId',
    'type' => 'write',
    'name' => 'create Message Template With Id',
    'description' => 'Creates an message template. You can optionally specify an Id for the template, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_messenger' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateMessenger',
    'type' => 'write',
    'name' => 'create Messenger',
    'description' => 'Creates a messenger. You can optionally specify an Id for the messenger, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_messenger_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateMessengerWithId',
    'type' => 'write',
    'name' => 'create Messenger With Id',
    'description' => 'Creates a messenger. You can optionally specify an Id for the messenger, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_oauth_scope' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateOauthScope',
    'type' => 'write',
    'name' => 'create OAuth Scope',
    'description' => 'Creates a new custom OAuth scope for an application. You must specify the Id of the application you are creating the scope for. You can optionally specify an Id for the OAuth scope on the URL, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_oauth_scope_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateOauthScopeWithId',
    'type' => 'write',
    'name' => 'create OAuth Scope With Id',
    'description' => 'Creates a new custom OAuth scope for an application. You must specify the Id of the application you are creating the scope for. You can optionally specify an Id for the OAuth scope on the URL, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_tenant' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateTenant',
    'type' => 'write',
    'name' => 'create Tenant',
    'description' => 'Creates a tenant. You can optionally specify an Id for the tenant, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_tenant_manager_identity_provider_type_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateTenantManagerIdentityProviderTypeConfigurationWithId',
    'type' => 'write',
    'name' => 'create Tenant Manager Identity Provider Type Configuration With Id',
    'description' => 'Creates a tenant manager identity provider type configuration for the given identity provider type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_tenant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateTenantWithId',
    'type' => 'write',
    'name' => 'create Tenant With Id',
    'description' => 'Creates a tenant. You can optionally specify an Id for the tenant, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_theme' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateTheme',
    'type' => 'write',
    'name' => 'create Theme',
    'description' => 'Creates a Theme. You can optionally specify an Id for the theme, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_theme_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateThemeWithId',
    'type' => 'write',
    'name' => 'create Theme With Id',
    'description' => 'Creates a Theme. You can optionally specify an Id for the theme, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_token' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateToken',
    'type' => 'write',
    'name' => 'create Token',
    'description' => 'Exchange User Credentials for a Token. If you will be using the Resource Owner Password Credential Grant, you will make a request to the Token endpoint to exchange the user\'s email and password for an access token. OR Exchange User Credentials for a Token. If you will be using the Resource Owner Password Credential Grant, you will make a request to the Token endpoint to exchange the user\'s email and password for an access token. OR Exchange a Refresh Token for an Access Token. If you will be usi',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUser',
    'type' => 'write',
    'name' => 'create User',
    'description' => 'Creates a user. You can optionally specify an Id for the user, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserAction',
    'type' => 'write',
    'name' => 'create User Action',
    'description' => 'Creates a user action. This action cannot be taken on a user until this call successfully returns. Anytime after that the user action can be applied to any user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_action_reason' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserActionReason',
    'type' => 'write',
    'name' => 'create User Action Reason',
    'description' => 'Creates a user reason. This user action reason cannot be used when actioning a user until this call completes successfully. Anytime after that the user action reason can be used.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_action_reason_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserActionReasonWithId',
    'type' => 'write',
    'name' => 'create User Action Reason With Id',
    'description' => 'Creates a user reason. This user action reason cannot be used when actioning a user until this call completes successfully. Anytime after that the user action reason can be used.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserActionWithId',
    'type' => 'write',
    'name' => 'create User Action With Id',
    'description' => 'Creates a user action. This action cannot be taken on a user until this call successfully returns. Anytime after that the user action can be applied to any user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_change_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserChangePassword',
    'type' => 'write',
    'name' => 'create User Change Password',
    'description' => 'Changes a user\'s password using their access token (JWT) instead of the changePasswordId A common use case for this method will be if you want to allow the user to change their own password. Remember to send refreshToken in the request body if you want to get a new refresh token when login using the returned oneTimePassword. OR Changes a user\'s password using their identity (loginId and password). Using a loginId instead of the changePasswordId bypasses the email verification and allows a passwo',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_consent' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserConsent',
    'type' => 'write',
    'name' => 'create User Consent',
    'description' => 'Creates a single User consent.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserConsentWithId',
    'type' => 'write',
    'name' => 'create User Consent With Id',
    'description' => 'Creates a single User consent.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_link_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserLinkWithId',
    'type' => 'write',
    'name' => 'create User Link With Id',
    'description' => 'Link an external user from a 3rd party identity provider to a FusionAuth user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_verify_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserVerifyEmail',
    'type' => 'write',
    'name' => 'create User Verify Email',
    'description' => 'Administratively verify a user\'s email address. Use this method to bypass email verification for the user. The request body will contain the userId to be verified. An API key is required when sending the userId in the request body. OR Confirms a user\'s email address. The request body will contain the verificationId. You may also be required to send a one-time use code based upon your configuration. When the tenant is configured to gate a user until their email address is verified, this procedure',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateUserWithId',
    'type' => 'write',
    'name' => 'create User With Id',
    'description' => 'Creates a user. You can optionally specify an Id for the user, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_webhook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateWebhook',
    'type' => 'write',
    'name' => 'create Webhook',
    'description' => 'Creates a webhook. You can optionally specify an Id for the webhook, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_create_webhook_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthCreateWebhookWithId',
    'type' => 'write',
    'name' => 'create Webhook With Id',
    'description' => 'Creates a webhook. You can optionally specify an Id for the webhook, if not provided one will be generated.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_apikey_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteApikeyWithId',
    'type' => 'write',
    'name' => 'delete APIKey With Id',
    'description' => 'Deletes the API key for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_application_role_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteApplicationRoleWithId',
    'type' => 'write',
    'name' => 'delete Application Role With Id',
    'description' => 'Hard deletes an application role. This is a dangerous operation and should not be used in most circumstances. This permanently removes the given role from all users that had it.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_application_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteApplicationWithId',
    'type' => 'write',
    'name' => 'delete Application With Id',
    'description' => 'Hard deletes an application. This is a dangerous operation and should not be used in most circumstances. This will delete the application, any registrations for that application, metrics and reports for the application, all the roles for the application, and any other data associated with the application. This operation could take a very long time, depending on the amount of data in your database. OR Deactivates the application with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_connector_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteConnectorWithId',
    'type' => 'write',
    'name' => 'delete Connector With Id',
    'description' => 'Deletes the connector for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteConsentWithId',
    'type' => 'write',
    'name' => 'delete Consent With Id',
    'description' => 'Deletes the consent for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_email_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteEmailTemplateWithId',
    'type' => 'write',
    'name' => 'delete Email Template With Id',
    'description' => 'Deletes the email template for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_entity_grant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteEntityGrantWithId',
    'type' => 'write',
    'name' => 'delete Entity Grant With Id',
    'description' => 'Deletes an Entity Grant for the given User or Entity.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_entity_type_permission_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteEntityTypePermissionWithId',
    'type' => 'write',
    'name' => 'delete Entity Type Permission With Id',
    'description' => 'Hard deletes a permission. This is a dangerous operation and should not be used in most circumstances. This permanently removes the given permission from all grants that had it.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_entity_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteEntityTypeWithId',
    'type' => 'write',
    'name' => 'delete Entity Type With Id',
    'description' => 'Deletes the Entity Type for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_entity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteEntityWithId',
    'type' => 'write',
    'name' => 'delete Entity With Id',
    'description' => 'Deletes the Entity for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_form_field_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteFormFieldWithId',
    'type' => 'write',
    'name' => 'delete Form Field With Id',
    'description' => 'Deletes the form field for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_form_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteFormWithId',
    'type' => 'write',
    'name' => 'delete Form With Id',
    'description' => 'Deletes the form for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_group_members_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteGroupMembersWithId',
    'type' => 'write',
    'name' => 'delete Group Members With Id',
    'description' => 'Removes users as members of a group.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_group_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteGroupWithId',
    'type' => 'write',
    'name' => 'delete Group With Id',
    'description' => 'Deletes the group for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_identity_provider_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteIdentityProviderWithId',
    'type' => 'write',
    'name' => 'delete Identity Provider With Id',
    'description' => 'Deletes the identity provider for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_ipaccess_control_list_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteIpaccessControlListWithId',
    'type' => 'write',
    'name' => 'delete IPAccess Control List With Id',
    'description' => 'Deletes the IP Access Control List for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_jwt_refresh' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteJwtRefresh',
    'type' => 'write',
    'name' => 'delete Jwt Refresh',
    'description' => 'Revokes refresh tokens using the information in the JSON body. The handling for this method is the same as the revokeRefreshToken method and is based on the information you provide in the RefreshDeleteRequest object. See that method for additional information. OR Revoke all refresh tokens that belong to a user by user Id for a specific application by applicationId. OR Revoke all refresh tokens that belong to a user by user Id. OR Revoke all refresh tokens that belong to an application by applica',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_key_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteKeyWithId',
    'type' => 'write',
    'name' => 'delete Key With Id',
    'description' => 'Deletes the key for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_lambda_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteLambdaWithId',
    'type' => 'write',
    'name' => 'delete Lambda With Id',
    'description' => 'Deletes the lambda for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_message_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteMessageTemplateWithId',
    'type' => 'write',
    'name' => 'delete Message Template With Id',
    'description' => 'Deletes the message template for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_messenger_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteMessengerWithId',
    'type' => 'write',
    'name' => 'delete Messenger With Id',
    'description' => 'Deletes the messenger for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_oauth_scope_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteOauthScopeWithId',
    'type' => 'write',
    'name' => 'delete OAuth Scope With Id',
    'description' => 'Hard deletes a custom OAuth scope. OAuth workflows that are still requesting the deleted OAuth scope may fail depending on the application\'s unknown scope policy.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_tenant_manager_identity_provider_type_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteTenantManagerIdentityProviderTypeConfigurationWithId',
    'type' => 'write',
    'name' => 'delete Tenant Manager Identity Provider Type Configuration With Id',
    'description' => 'Deletes the tenant manager identity provider type configuration for the given identity provider type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_tenant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteTenantWithId',
    'type' => 'write',
    'name' => 'delete Tenant With Id',
    'description' => 'Deletes the tenant based on the given request (sent to the API as JSON). This permanently deletes all information, metrics, reports and data associated with the tenant and everything under the tenant (applications, users, etc). OR Deletes the tenant for the given Id asynchronously. This method is helpful if you do not want to wait for the delete operation to complete. OR Deletes the tenant based on the given Id on the URL. This permanently deletes all information, metrics, reports and data assoc',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_theme_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteThemeWithId',
    'type' => 'write',
    'name' => 'delete Theme With Id',
    'description' => 'Deletes the theme for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_action_reason_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserActionReasonWithId',
    'type' => 'write',
    'name' => 'delete User Action Reason With Id',
    'description' => 'Deletes the user action reason for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserActionWithId',
    'type' => 'write',
    'name' => 'delete User Action With Id',
    'description' => 'Deletes the user action for the given Id. This permanently deletes the user action and also any history and logs of the action being applied to any users. OR Deactivates the user action with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_bulk' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserBulk',
    'type' => 'write',
    'name' => 'delete User Bulk',
    'description' => 'Deletes the users with the given Ids, or users matching the provided JSON query or queryString. The order of preference is Ids, query and then queryString, it is recommended to only provide one of the three for the request. This method can be used to deactivate or permanently delete (hard-delete) users based upon the hardDelete boolean in the request body. Using the dryRun parameter you may also request the result of the action without actually deleting or deactivating any users. OR Deactivates ',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_link_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserLinkWithId',
    'type' => 'write',
    'name' => 'delete User Link With Id',
    'description' => 'Remove an existing link that has been made from a 3rd party identity provider to a FusionAuth user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserRegistrationWithId',
    'type' => 'write',
    'name' => 'delete User Registration With Id',
    'description' => 'Deletes the user registration for the given user and application along with the given JSON body that contains the event information. OR Deletes the user registration for the given user and application.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_two_factor_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserTwoFactorWithId',
    'type' => 'write',
    'name' => 'delete User Two Factor With Id',
    'description' => 'Disable two-factor authentication for a user using a JSON body rather than URL parameters. OR Disable two-factor authentication for a user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteUserWithId',
    'type' => 'write',
    'name' => 'delete User With Id',
    'description' => 'Deletes the user based on the given request (sent to the API as JSON). This permanently deletes all information, metrics, reports and data associated with the user. OR Deletes the user for the given Id. This permanently deletes all information, metrics, reports and data associated with the user. OR Deactivates the user with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_web_authn_credential_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteWebAuthnCredentialWithId',
    'type' => 'write',
    'name' => 'delete Web Authn Credential With Id',
    'description' => 'Deletes the WebAuthn credential for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_web_authn_credentials_for_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteWebAuthnCredentialsForUserWithId',
    'type' => 'write',
    'name' => 'delete Web Authn Credentials For User With Id',
    'description' => 'Deletes all of the WebAuthn credentials for the given User Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_delete_webhook_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthDeleteWebhookWithId',
    'type' => 'write',
    'name' => 'delete Webhook With Id',
    'description' => 'Deletes the webhook for the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_enable_two_factor_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthEnableTwoFactorWithId',
    'type' => 'write',
    'name' => 'enable Two Factor With Id',
    'description' => 'Enable two-factor authentication for a user.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_exchange_refresh_token_for_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthExchangeRefreshTokenForJwtwithId',
    'type' => 'write',
    'name' => 'exchange Refresh Token For JWTWith Id',
    'description' => 'Exchange a refresh token for a new JWT.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_forgot_password_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthForgotPasswordWithId',
    'type' => 'write',
    'name' => 'forgot Password With Id',
    'description' => 'Begins the forgot password sequence, which kicks off an email to the user so that they can reset their password.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_generate_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthGenerateKey',
    'type' => 'write',
    'name' => 'generate Key',
    'description' => 'Generate a new RSA or EC key pair or an HMAC secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_generate_key_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthGenerateKeyWithId',
    'type' => 'write',
    'name' => 'generate Key With Id',
    'description' => 'Generate a new RSA or EC key pair or an HMAC secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_generate_two_factor_recovery_codes_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthGenerateTwoFactorRecoveryCodesWithId',
    'type' => 'write',
    'name' => 'generate Two Factor Recovery Codes With Id',
    'description' => 'Generate two-factor recovery codes for a user. Generating two-factor recovery codes will invalidate any existing recovery codes.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_generate_two_factor_secret_using_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthGenerateTwoFactorSecretUsingJwtwithId',
    'type' => 'read',
    'name' => 'generate Two Factor Secret Using JWTWith Id',
    'description' => 'Generate a Two Factor secret that can be used to enable Two Factor authentication for a User. The response will contain both the secret and a Base32 encoded form of the secret which can be shown to a User when using a 2 Step Authentication application such as Google Authenticator.',
    'icon' => 'ph:key',
  ),
  'fusionauth_identity_provider_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthIdentityProviderLoginWithId',
    'type' => 'write',
    'name' => 'identity Provider Login With Id',
    'description' => 'Handles login via third-parties including Social login, external OAuth and OpenID Connect, and other login systems.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_import_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthImportKey',
    'type' => 'write',
    'name' => 'import Key',
    'description' => 'Import an existing RSA or EC key pair or an HMAC secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_import_key_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthImportKeyWithId',
    'type' => 'write',
    'name' => 'import Key With Id',
    'description' => 'Import an existing RSA or EC key pair or an HMAC secret.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_import_refresh_tokens_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthImportRefreshTokensWithId',
    'type' => 'write',
    'name' => 'import Refresh Tokens With Id',
    'description' => 'Bulk imports refresh tokens. This request performs minimal validation and runs batch inserts of refresh tokens with the expectation that each token represents a user that already exists and is registered for the corresponding FusionAuth Application. This is done to increases the insert performance. Therefore, if you encounter an error due to a database key violation, the response will likely offer a generic explanation. If you encounter an error, you may optionally enable additional validation t',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_import_users_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthImportUsersWithId',
    'type' => 'write',
    'name' => 'import Users With Id',
    'description' => 'Bulk imports users. This request performs minimal validation and runs batch inserts of users with the expectation that each user does not yet exist and each registration corresponds to an existing FusionAuth Application. This is done to increases the insert performance. Therefore, if you encounter an error due to a database key violation, the response will likely offer a generic explanation. If you encounter an error, you may optionally enable additional validation to receive a JSON response bod',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_import_web_authn_credential_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthImportWebAuthnCredentialWithId',
    'type' => 'write',
    'name' => 'import Web Authn Credential With Id',
    'description' => 'Import a WebAuthn credential',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_issue_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthIssueJwtwithId',
    'type' => 'read',
    'name' => 'issue JWTWith Id',
    'description' => 'Issue a new access token (JWT) for the requested Application after ensuring the provided JWT is valid. A valid access token is properly signed and not expired. This API may be used in an SSO configuration to issue new tokens for another application after the user has obtained a valid token from authentication.',
    'icon' => 'ph:key',
  ),
  'fusionauth_login_ping_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthLoginPingWithId',
    'type' => 'write',
    'name' => 'login Ping With Id',
    'description' => 'Sends a ping to FusionAuth indicating that the user was automatically logged into an application. When using FusionAuth\'s SSO or your own, you should call this if the user is already logged in centrally, but accesses an application where they no longer have a session. This helps correctly track login counts, times and helps with reporting.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_login_ping_with_request_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthLoginPingWithRequestWithId',
    'type' => 'write',
    'name' => 'login Ping With Request With Id',
    'description' => 'Sends a ping to FusionAuth indicating that the user was automatically logged into an application. When using FusionAuth\'s SSO or your own, you should call this if the user is already logged in centrally, but accesses an application where they no longer have a session. This helps correctly track login counts, times and helps with reporting.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthLoginWithId',
    'type' => 'write',
    'name' => 'login With Id',
    'description' => 'Authenticates a user to FusionAuth. This API optionally requires an API key. See Application.loginConfiguration.requireAuthentication.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_modify_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthModifyActionWithId',
    'type' => 'write',
    'name' => 'modify Action With Id',
    'description' => 'Modifies a temporal user action by changing the expiration of the action and optionally adding a comment to the action.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_passwordless_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPasswordlessLoginWithId',
    'type' => 'write',
    'name' => 'passwordless Login With Id',
    'description' => 'Complete a login request using a passwordless code',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_apikey_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchApikeyWithId',
    'type' => 'write',
    'name' => 'patch APIKey With Id',
    'description' => 'Updates an API key with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_application_role_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchApplicationRoleWithId',
    'type' => 'write',
    'name' => 'patch Application Role With Id',
    'description' => 'Updates, via PATCH, the application role with the given Id for the application.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_application_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchApplicationWithId',
    'type' => 'write',
    'name' => 'patch Application With Id',
    'description' => 'Updates, via PATCH, the application with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_connector_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchConnectorWithId',
    'type' => 'write',
    'name' => 'patch Connector With Id',
    'description' => 'Updates, via PATCH, the connector with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchConsentWithId',
    'type' => 'write',
    'name' => 'patch Consent With Id',
    'description' => 'Updates, via PATCH, the consent with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_email_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchEmailTemplateWithId',
    'type' => 'write',
    'name' => 'patch Email Template With Id',
    'description' => 'Updates, via PATCH, the email template with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_entity_type_permission_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchEntityTypePermissionWithId',
    'type' => 'write',
    'name' => 'patch Entity Type Permission With Id',
    'description' => 'Patches the permission with the given Id for the entity type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_entity_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchEntityTypeWithId',
    'type' => 'write',
    'name' => 'patch Entity Type With Id',
    'description' => 'Updates, via PATCH, the Entity Type with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_entity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchEntityWithId',
    'type' => 'write',
    'name' => 'patch Entity With Id',
    'description' => 'Updates, via PATCH, the Entity with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_form_field_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchFormFieldWithId',
    'type' => 'write',
    'name' => 'patch Form Field With Id',
    'description' => 'Patches the form field with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_form_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchFormWithId',
    'type' => 'write',
    'name' => 'patch Form With Id',
    'description' => 'Patches the form with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_group_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchGroupWithId',
    'type' => 'write',
    'name' => 'patch Group With Id',
    'description' => 'Updates, via PATCH, the group with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_identity_provider_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchIdentityProviderWithId',
    'type' => 'write',
    'name' => 'patch Identity Provider With Id',
    'description' => 'Updates, via PATCH, the identity provider with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_integrations_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchIntegrationsWithId',
    'type' => 'write',
    'name' => 'patch Integrations With Id',
    'description' => 'Updates, via PATCH, the available integrations.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_ipaccess_control_list_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchIpaccessControlListWithId',
    'type' => 'write',
    'name' => 'patch IPAccess Control List With Id',
    'description' => 'Update the IP Access Control List with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_lambda_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchLambdaWithId',
    'type' => 'write',
    'name' => 'patch Lambda With Id',
    'description' => 'Updates, via PATCH, the lambda with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_message_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchMessageTemplateWithId',
    'type' => 'write',
    'name' => 'patch Message Template With Id',
    'description' => 'Updates, via PATCH, the message template with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_messenger_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchMessengerWithId',
    'type' => 'write',
    'name' => 'patch Messenger With Id',
    'description' => 'Updates, via PATCH, the messenger with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_oauth_scope_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchOauthScopeWithId',
    'type' => 'write',
    'name' => 'patch OAuth Scope With Id',
    'description' => 'Updates, via PATCH, the custom OAuth scope with the given Id for the application.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchRegistrationWithId',
    'type' => 'write',
    'name' => 'patch Registration With Id',
    'description' => 'Updates, via PATCH, the registration for the user with the given Id and the application defined in the request.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_system_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchSystemConfigurationWithId',
    'type' => 'write',
    'name' => 'patch System Configuration With Id',
    'description' => 'Updates, via PATCH, the system configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_tenant_manager_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchTenantManagerConfigurationWithId',
    'type' => 'write',
    'name' => 'patch Tenant Manager Configuration With Id',
    'description' => 'Updates, via PATCH, the Tenant Manager configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_tenant_manager_identity_provider_type_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchTenantManagerIdentityProviderTypeConfigurationWithId',
    'type' => 'write',
    'name' => 'patch Tenant Manager Identity Provider Type Configuration With Id',
    'description' => 'Patches the tenant manager identity provider type configuration for the given identity provider type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_tenant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchTenantWithId',
    'type' => 'write',
    'name' => 'patch Tenant With Id',
    'description' => 'Updates, via PATCH, the tenant with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_theme_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchThemeWithId',
    'type' => 'write',
    'name' => 'patch Theme With Id',
    'description' => 'Updates, via PATCH, the theme with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_user_action_reason_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchUserActionReasonWithId',
    'type' => 'write',
    'name' => 'patch User Action Reason With Id',
    'description' => 'Updates, via PATCH, the user action reason with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_user_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchUserActionWithId',
    'type' => 'write',
    'name' => 'patch User Action With Id',
    'description' => 'Updates, via PATCH, the user action with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_user_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchUserConsentWithId',
    'type' => 'write',
    'name' => 'patch User Consent With Id',
    'description' => 'Updates, via PATCH, a single User consent by Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchUserWithId',
    'type' => 'write',
    'name' => 'patch User With Id',
    'description' => 'Updates, via PATCH, the user with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_patch_webhook_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthPatchWebhookWithId',
    'type' => 'write',
    'name' => 'patch Webhook With Id',
    'description' => 'Patches the webhook with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_reconcile_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthReconcileJwtwithId',
    'type' => 'write',
    'name' => 'reconcile JWTWith Id',
    'description' => 'Reconcile a User to FusionAuth using JWT issued from another Identity Provider.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_register' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRegister',
    'type' => 'write',
    'name' => 'register',
    'description' => 'Registers a user for an application. If you provide the User and the UserRegistration object on this request, it will create the user as well as register them for the application. This is called a Full Registration. However, if you only provide the UserRegistration object, then the user must already exist and they will be registered for the application. The user Id can also be provided and it will either be used to look up an existing user or it will be used for the newly created User.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_register_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRegisterWithId',
    'type' => 'write',
    'name' => 'register With Id',
    'description' => 'Registers a user for an application. If you provide the User and the UserRegistration object on this request, it will create the user as well as register them for the application. This is called a Full Registration. However, if you only provide the UserRegistration object, then the user must already exist and they will be registered for the application. The user Id can also be provided and it will either be used to look up an existing user or it will be used for the newly created User.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_reindex_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthReindexWithId',
    'type' => 'write',
    'name' => 'reindex With Id',
    'description' => 'Requests Elasticsearch to delete and rebuild the index for FusionAuth users or entities. Be very careful when running this request as it will increase the CPU and I/O load on your database until the operation completes. Generally speaking you do not ever need to run this operation unless instructed by FusionAuth support, or if you are migrating a database another system and you are not brining along the Elasticsearch index. You have been warned.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_remove_user_from_family_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRemoveUserFromFamilyWithId',
    'type' => 'write',
    'name' => 'remove User From Family With Id',
    'description' => 'Removes a user from the family with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_retrieve_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveActionWithId',
    'type' => 'read',
    'name' => 'retrieve Action With Id',
    'description' => 'Retrieves a single action log (the log of a user action that was taken on a user previously) for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_apikey_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveApikeyWithId',
    'type' => 'read',
    'name' => 'retrieve APIKey With Id',
    'description' => 'Retrieves an authentication API key for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_application' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveApplication',
    'type' => 'read',
    'name' => 'retrieve Application',
    'description' => 'Retrieves all the applications that are currently inactive. OR Retrieves the application for the given Id or all the applications if the Id is null.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_application_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveApplicationWithId',
    'type' => 'read',
    'name' => 'retrieve Application With Id',
    'description' => 'Retrieves the application for the given Id or all the applications if the Id is null.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_audit_log_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveAuditLogWithId',
    'type' => 'read',
    'name' => 'retrieve Audit Log With Id',
    'description' => 'Retrieves a single audit log for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_connector_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveConnectorWithId',
    'type' => 'read',
    'name' => 'retrieve Connector With Id',
    'description' => 'Retrieves the connector with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveConsentWithId',
    'type' => 'read',
    'name' => 'retrieve Consent With Id',
    'description' => 'Retrieves the Consent for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_daily_active_report_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveDailyActiveReportWithId',
    'type' => 'read',
    'name' => 'retrieve Daily Active Report With Id',
    'description' => 'Retrieves the daily active user report between the two instants. If you specify an application Id, it will only return the daily active counts for that application.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_device_user_code' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveDeviceUserCode',
    'type' => 'read',
    'name' => 'retrieve Device User Code',
    'description' => 'Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. This request will require an API key. OR Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_device_validate' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveDeviceValidate',
    'type' => 'read',
    'name' => 'retrieve Device Validate',
    'description' => 'Validates the end-user provided user_code from the user-interaction of the Device Authorization Grant. If you build your own activation form you should validate the user provided code prior to beginning the Authorization grant. OR Validates the end-user provided user_code from the user-interaction of the Device Authorization Grant. If you build your own activation form you should validate the user provided code prior to beginning the Authorization grant.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_email_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEmailTemplate',
    'type' => 'read',
    'name' => 'retrieve Email Template',
    'description' => 'Retrieves the email template for the given Id. If you don\'t specify the Id, this will return all the email templates.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_email_template_preview_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEmailTemplatePreviewWithId',
    'type' => 'write',
    'name' => 'retrieve Email Template Preview With Id',
    'description' => 'Creates a preview of the email template provided in the request. This allows you to preview an email template that hasn\'t been saved to the database yet. The entire email template does not need to be provided on the request. This will create the preview based on whatever is given.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_retrieve_email_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEmailTemplateWithId',
    'type' => 'read',
    'name' => 'retrieve Email Template With Id',
    'description' => 'Retrieves the email template for the given Id. If you don\'t specify the Id, this will return all the email templates.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_entity_grant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEntityGrantWithId',
    'type' => 'read',
    'name' => 'retrieve Entity Grant With Id',
    'description' => 'Retrieves an Entity Grant for the given Entity and User/Entity.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_entity_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEntityTypeWithId',
    'type' => 'read',
    'name' => 'retrieve Entity Type With Id',
    'description' => 'Retrieves the Entity Type for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_entity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEntityWithId',
    'type' => 'read',
    'name' => 'retrieve Entity With Id',
    'description' => 'Retrieves the Entity for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_event_log_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveEventLogWithId',
    'type' => 'read',
    'name' => 'retrieve Event Log With Id',
    'description' => 'Retrieves a single event log for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_families_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveFamiliesWithId',
    'type' => 'read',
    'name' => 'retrieve Families With Id',
    'description' => 'Retrieves all the families that a user belongs to.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_family_members_by_family_id_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveFamilyMembersByFamilyIdWithId',
    'type' => 'read',
    'name' => 'retrieve Family Members By Family Id With Id',
    'description' => 'Retrieves all the members of a family by the unique Family Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_form_field_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveFormFieldWithId',
    'type' => 'read',
    'name' => 'retrieve Form Field With Id',
    'description' => 'Retrieves the form field with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_form_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveFormWithId',
    'type' => 'read',
    'name' => 'retrieve Form With Id',
    'description' => 'Retrieves the form with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_group_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveGroupWithId',
    'type' => 'read',
    'name' => 'retrieve Group With Id',
    'description' => 'Retrieves the group for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_identity_provider_by_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIdentityProviderByTypeWithId',
    'type' => 'read',
    'name' => 'retrieve Identity Provider By Type With Id',
    'description' => 'Retrieves one or more identity provider for the given type. For types such as Google, Facebook, Twitter and LinkedIn, only a single identity provider can exist. For types such as OpenID Connect and SAMLv2 more than one identity provider can be configured so this request may return multiple identity providers.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_identity_provider_connection_test_results_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIdentityProviderConnectionTestResultsWithId',
    'type' => 'read',
    'name' => 'retrieve Identity Provider Connection Test Results With Id',
    'description' => 'Retrieves the results for an identity provider connection test.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_identity_provider_link' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIdentityProviderLink',
    'type' => 'read',
    'name' => 'retrieve Identity Provider Link',
    'description' => 'Retrieve all Identity Provider users (links) for the user. Specify the optional identityProviderId to retrieve links for a particular IdP. OR Retrieve a single Identity Provider user (link).',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_identity_provider_lookup' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIdentityProviderLookup',
    'type' => 'read',
    'name' => 'retrieve Identity Provider Lookup',
    'description' => 'Retrieves the identity provider for the given domain and tenantId. A 200 response code indicates the domain is managed by a registered identity provider. A 404 indicates the domain is not managed. OR Retrieves any global identity providers for the given domain. A 200 response code indicates the domain is managed by a registered identity provider. A 404 indicates the domain is not managed.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_identity_provider_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIdentityProviderWithId',
    'type' => 'read',
    'name' => 'retrieve Identity Provider With Id',
    'description' => 'Retrieves the identity provider for the given Id or all the identity providers if the Id is null.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_ipaccess_control_list_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveIpaccessControlListWithId',
    'type' => 'read',
    'name' => 'retrieve IPAccess Control List With Id',
    'description' => 'Retrieves the IP Access Control List with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_json_web_key_set_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveJsonWebKeySetWithId',
    'type' => 'read',
    'name' => 'retrieve Json Web Key Set With Id',
    'description' => 'Returns public keys used by FusionAuth to cryptographically verify JWTs using the JSON Web Key format.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_jwt_public_key' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveJwtPublicKey',
    'type' => 'read',
    'name' => 'retrieve Jwt Public Key',
    'description' => 'Retrieves the Public Key configured for verifying the JSON Web Tokens (JWT) issued by the Login API by the Application Id. OR Retrieves the Public Key configured for verifying JSON Web Tokens (JWT) by the key Id (kid).',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_key_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveKeyWithId',
    'type' => 'read',
    'name' => 'retrieve Key With Id',
    'description' => 'Retrieves the key for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_keys_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveKeysWithId',
    'type' => 'read',
    'name' => 'retrieve Keys With Id',
    'description' => 'Retrieves all the keys.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_lambda_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveLambdaWithId',
    'type' => 'read',
    'name' => 'retrieve Lambda With Id',
    'description' => 'Retrieves the lambda for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_lambdas_by_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveLambdasByTypeWithId',
    'type' => 'read',
    'name' => 'retrieve Lambdas By Type With Id',
    'description' => 'Retrieves all the lambdas for the provided type.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_message_template' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveMessageTemplate',
    'type' => 'read',
    'name' => 'retrieve Message Template',
    'description' => 'Retrieves the message template for the given Id. If you don\'t specify the Id, this will return all the message templates.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_message_template_preview_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveMessageTemplatePreviewWithId',
    'type' => 'write',
    'name' => 'retrieve Message Template Preview With Id',
    'description' => 'Creates a preview of the message template provided in the request, normalized to a given locale.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_retrieve_message_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveMessageTemplateWithId',
    'type' => 'read',
    'name' => 'retrieve Message Template With Id',
    'description' => 'Retrieves the message template for the given Id. If you don\'t specify the Id, this will return all the message templates.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_messenger_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveMessengerWithId',
    'type' => 'read',
    'name' => 'retrieve Messenger With Id',
    'description' => 'Retrieves the messenger with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_monthly_active_report_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveMonthlyActiveReportWithId',
    'type' => 'read',
    'name' => 'retrieve Monthly Active Report With Id',
    'description' => 'Retrieves the monthly active user report between the two instants. If you specify an application Id, it will only return the monthly active counts for that application.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_oauth_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveOauthConfigurationWithId',
    'type' => 'read',
    'name' => 'retrieve Oauth Configuration With Id',
    'description' => 'Retrieves the Oauth2 configuration for the application for the given Application Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_oauth_scope_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveOauthScopeWithId',
    'type' => 'read',
    'name' => 'retrieve OAuth Scope With Id',
    'description' => 'Retrieves a custom OAuth scope.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_open_id_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveOpenIdConfigurationWithId',
    'type' => 'read',
    'name' => 'retrieve Open Id Configuration With Id',
    'description' => 'Returns the well known OpenID Configuration JSON document',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_password_validation_rules_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrievePasswordValidationRulesWithId',
    'type' => 'read',
    'name' => 'retrieve Password Validation Rules With Id',
    'description' => 'Retrieves the password validation rules for a specific tenant. This method requires a tenantId to be provided through the use of a Tenant scoped API key or an HTTP header X-FusionAuth-TenantId to specify the Tenant Id. This API does not require an API key.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_password_validation_rules_with_tenant_id_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrievePasswordValidationRulesWithTenantIdWithId',
    'type' => 'read',
    'name' => 'retrieve Password Validation Rules With Tenant Id With Id',
    'description' => 'Retrieves the password validation rules for a specific tenant. This API does not require an API key.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_pending_children_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrievePendingChildrenWithId',
    'type' => 'read',
    'name' => 'retrieve Pending Children With Id',
    'description' => 'Retrieves all the children for the given parent email address.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_pending_link_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrievePendingLinkWithId',
    'type' => 'read',
    'name' => 'retrieve Pending Link With Id',
    'description' => 'Retrieve a pending identity provider link. This is useful to validate a pending link and retrieve meta-data about the identity provider link.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_reactor_metrics_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveReactorMetricsWithId',
    'type' => 'read',
    'name' => 'retrieve Reactor Metrics With Id',
    'description' => 'Retrieves the FusionAuth Reactor metrics.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_refresh_token_by_id_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveRefreshTokenByIdWithId',
    'type' => 'read',
    'name' => 'retrieve Refresh Token By Id With Id',
    'description' => 'Retrieves a single refresh token by unique Id. This is not the same thing as the string value of the refresh token. If you have that, you already have what you need.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_refresh_tokens_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveRefreshTokensWithId',
    'type' => 'read',
    'name' => 'retrieve Refresh Tokens With Id',
    'description' => 'Retrieves the refresh tokens that belong to the user with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_registration_report_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveRegistrationReportWithId',
    'type' => 'read',
    'name' => 'retrieve Registration Report With Id',
    'description' => 'Retrieves the registration report between the two instants. If you specify an application Id, it will only return the registration counts for that application.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveRegistrationWithId',
    'type' => 'read',
    'name' => 'retrieve Registration With Id',
    'description' => 'Retrieves the user registration for the user with the given Id and the given application Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_report_login' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveReportLogin',
    'type' => 'read',
    'name' => 'retrieve Report Login',
    'description' => 'Retrieves the login report between the two instants for a particular user by login Id, using specific loginIdTypes. If you specify an application id, it will only return the login counts for that application. OR Retrieves the login report between the two instants for a particular user by login Id. If you specify an application Id, it will only return the login counts for that application. OR Retrieves the login report between the two instants for a particular user by Id. If you specify an applic',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_status' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveStatus',
    'type' => 'read',
    'name' => 'retrieve Status',
    'description' => 'Retrieves the FusionAuth system status using an API key. Using an API key will cause the response to include the product version, health checks and various runtime metrics. OR Retrieves the FusionAuth system status. This request is anonymous and does not require an API key. When an API key is not provided the response will contain a single value in the JSON response indicating the current health check.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_system_health_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveSystemHealthWithId',
    'type' => 'read',
    'name' => 'retrieve System Health With Id',
    'description' => 'Retrieves the FusionAuth system health. This API will return 200 if the system is healthy, and 500 if the system is un-healthy.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_tenant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveTenantWithId',
    'type' => 'read',
    'name' => 'retrieve Tenant With Id',
    'description' => 'Retrieves the tenant for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_theme_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveThemeWithId',
    'type' => 'read',
    'name' => 'retrieve Theme With Id',
    'description' => 'Retrieves the theme for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_total_report_with_excludes_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveTotalReportWithExcludesWithId',
    'type' => 'read',
    'name' => 'retrieve Total Report With Excludes With Id',
    'description' => 'Retrieves the totals report. This allows excluding applicationTotals from the report. An empty list will include the applicationTotals.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_two_factor_recovery_codes_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveTwoFactorRecoveryCodesWithId',
    'type' => 'read',
    'name' => 'retrieve Two Factor Recovery Codes With Id',
    'description' => 'Retrieve two-factor recovery codes for a user.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_two_factor_status_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveTwoFactorStatusWithId',
    'type' => 'read',
    'name' => 'retrieve Two Factor Status With Id',
    'description' => 'Retrieve a user\'s two-factor status. This can be used to see if a user will need to complete a two-factor challenge to complete a login, and optionally identify the state of the two-factor trust across various applications.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_two_factor_status_with_request_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveTwoFactorStatusWithRequestWithId',
    'type' => 'write',
    'name' => 'retrieve Two Factor Status With Request With Id',
    'description' => 'Retrieve a user\'s two-factor status. This can be used to see if a user will need to complete a two-factor challenge to complete a login, and optionally identify the state of the two-factor trust across various applications. This operation provides more payload options than retrieveTwoFactorStatus.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_retrieve_user' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUser',
    'type' => 'read',
    'name' => 'retrieve User',
    'description' => 'Retrieves the user by a verificationId. The intended use of this API is to retrieve a user after the forgot password workflow has been initiated and you may not know the user\'s email or username. OR Retrieves the user for the given username. OR Retrieves the user for the loginId, using specific loginIdTypes. OR Retrieves the user for the loginId. The loginId can be either the username or the email. OR Retrieves the user for the given email. OR Retrieves the user by a change password Id. The inte',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_action' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserAction',
    'type' => 'read',
    'name' => 'retrieve User Action',
    'description' => 'Retrieves the user action for the given Id. If you pass in null for the Id, this will return all the user actions. OR Retrieves all the user actions that are currently inactive.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_action_reason' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserActionReason',
    'type' => 'read',
    'name' => 'retrieve User Action Reason',
    'description' => 'Retrieves the user action reason for the given Id. If you pass in null for the Id, this will return all the user action reasons.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_action_reason_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserActionReasonWithId',
    'type' => 'read',
    'name' => 'retrieve User Action Reason With Id',
    'description' => 'Retrieves the user action reason for the given Id. If you pass in null for the Id, this will return all the user action reasons.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserActionWithId',
    'type' => 'read',
    'name' => 'retrieve User Action With Id',
    'description' => 'Retrieves the user action for the given Id. If you pass in null for the Id, this will return all the user actions.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_actioning' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserActioning',
    'type' => 'read',
    'name' => 'retrieve User Actioning',
    'description' => 'Retrieves all the actions for the user with the given Id that are currently inactive. An inactive action means one that is time based and has been canceled or has expired, or is not time based. OR Retrieves all the actions for the user with the given Id that are currently active. An active action means one that is time based and has not been canceled, and has not ended. OR Retrieves all the actions for the user with the given Id that are currently preventing the User from logging in. OR Retrieve',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_change_password' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserChangePassword',
    'type' => 'read',
    'name' => 'retrieve User Change Password',
    'description' => 'Check to see if the user must obtain a Trust Request Id in order to complete a change password request. When a user has enabled Two-Factor authentication, before you are allowed to use the Change Password API to change your password, you must obtain a Trust Request Id by completing a Two-Factor Step-Up authentication. An HTTP status code of 400 with a general error code of [TrustTokenRequired] indicates that a Trust Token is required to make a POST request to this API. OR Check to see if the use',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_change_password_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserChangePasswordWithId',
    'type' => 'read',
    'name' => 'retrieve User Change Password With Id',
    'description' => 'Check to see if the user must obtain a Trust Token Id in order to complete a change password request. When a user has enabled Two-Factor authentication, before you are allowed to use the Change Password API to change your password, you must obtain a Trust Token by completing a Two-Factor Step-Up authentication. An HTTP status code of 400 with a general error code of [TrustTokenRequired] indicates that a Trust Token is required to make a POST request to this API. OR Check to see if the user must ',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_comments_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserCommentsWithId',
    'type' => 'read',
    'name' => 'retrieve User Comments With Id',
    'description' => 'Retrieves all the comments for the user with the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserConsentWithId',
    'type' => 'read',
    'name' => 'retrieve User Consent With Id',
    'description' => 'Retrieve a single User consent by Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_consents_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserConsentsWithId',
    'type' => 'read',
    'name' => 'retrieve User Consents With Id',
    'description' => 'Retrieves all the consents for a User.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_info_from_access_token_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserInfoFromAccessTokenWithId',
    'type' => 'read',
    'name' => 'retrieve User Info From Access Token With Id',
    'description' => 'Call the UserInfo endpoint to retrieve User Claims from the access token issued by FusionAuth.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_recent_login' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserRecentLogin',
    'type' => 'read',
    'name' => 'retrieve User Recent Login',
    'description' => 'Retrieves the last number of login records for a user. OR Retrieves the last number of login records.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveUserWithId',
    'type' => 'read',
    'name' => 'retrieve User With Id',
    'description' => 'Retrieves the user for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_version_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveVersionWithId',
    'type' => 'read',
    'name' => 'retrieve Version With Id',
    'description' => 'Retrieves the FusionAuth version string.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_web_authn_credential_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebAuthnCredentialWithId',
    'type' => 'read',
    'name' => 'retrieve Web Authn Credential With Id',
    'description' => 'Retrieves the WebAuthn credential for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_web_authn_credentials_for_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebAuthnCredentialsForUserWithId',
    'type' => 'read',
    'name' => 'retrieve Web Authn Credentials For User With Id',
    'description' => 'Retrieves all WebAuthn credentials for the given user.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_webhook' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebhook',
    'type' => 'read',
    'name' => 'retrieve Webhook',
    'description' => 'Retrieves the webhook for the given Id. If you pass in null for the Id, this will return all the webhooks.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_webhook_attempt_log_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebhookAttemptLogWithId',
    'type' => 'read',
    'name' => 'retrieve Webhook Attempt Log With Id',
    'description' => 'Retrieves a single webhook attempt log for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_webhook_event_log_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebhookEventLogWithId',
    'type' => 'read',
    'name' => 'retrieve Webhook Event Log With Id',
    'description' => 'Retrieves a single webhook event log for the given Id.',
    'icon' => 'ph:key',
  ),
  'fusionauth_retrieve_webhook_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRetrieveWebhookWithId',
    'type' => 'read',
    'name' => 'retrieve Webhook With Id',
    'description' => 'Retrieves the webhook for the given Id. If you pass in null for the Id, this will return all the webhooks.',
    'icon' => 'ph:key',
  ),
  'fusionauth_revoke_refresh_token_by_id_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRevokeRefreshTokenByIdWithId',
    'type' => 'write',
    'name' => 'revoke Refresh Token By Id With Id',
    'description' => 'Revokes a single refresh token by the unique Id. The unique Id is not sensitive as it cannot be used to obtain another JWT.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_revoke_user_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthRevokeUserConsentWithId',
    'type' => 'write',
    'name' => 'revoke User Consent With Id',
    'description' => 'Revokes a single User consent by Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_applications_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchApplicationsWithId',
    'type' => 'write',
    'name' => 'search Applications With Id',
    'description' => 'Searches applications with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_audit_logs_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchAuditLogsWithId',
    'type' => 'write',
    'name' => 'search Audit Logs With Id',
    'description' => 'Searches the audit logs with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_consents_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchConsentsWithId',
    'type' => 'write',
    'name' => 'search Consents With Id',
    'description' => 'Searches consents with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_email_templates_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEmailTemplatesWithId',
    'type' => 'write',
    'name' => 'search Email Templates With Id',
    'description' => 'Searches email templates with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_entities_by_ids_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEntitiesByIdsWithId',
    'type' => 'read',
    'name' => 'search Entities By Ids With Id',
    'description' => 'Retrieves the entities for the given Ids. If any Id is invalid, it is ignored.',
    'icon' => 'ph:key',
  ),
  'fusionauth_search_entities_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEntitiesWithId',
    'type' => 'write',
    'name' => 'search Entities With Id',
    'description' => 'Searches entities with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_entity_grants_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEntityGrantsWithId',
    'type' => 'write',
    'name' => 'search Entity Grants With Id',
    'description' => 'Searches Entity Grants with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_entity_types_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEntityTypesWithId',
    'type' => 'write',
    'name' => 'search Entity Types With Id',
    'description' => 'Searches the entity types with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_event_logs_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchEventLogsWithId',
    'type' => 'write',
    'name' => 'search Event Logs With Id',
    'description' => 'Searches the event logs with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_group_members_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchGroupMembersWithId',
    'type' => 'write',
    'name' => 'search Group Members With Id',
    'description' => 'Searches group members with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_groups_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchGroupsWithId',
    'type' => 'write',
    'name' => 'search Groups With Id',
    'description' => 'Searches groups with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_identity_providers_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchIdentityProvidersWithId',
    'type' => 'write',
    'name' => 'search Identity Providers With Id',
    'description' => 'Searches identity providers with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_ipaccess_control_lists_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchIpaccessControlListsWithId',
    'type' => 'write',
    'name' => 'search IPAccess Control Lists With Id',
    'description' => 'Searches the IP Access Control Lists with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_keys_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchKeysWithId',
    'type' => 'write',
    'name' => 'search Keys With Id',
    'description' => 'Searches keys with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_lambdas_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchLambdasWithId',
    'type' => 'write',
    'name' => 'search Lambdas With Id',
    'description' => 'Searches lambdas with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_login_records_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchLoginRecordsWithId',
    'type' => 'write',
    'name' => 'search Login Records With Id',
    'description' => 'Searches the login records with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_tenants_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchTenantsWithId',
    'type' => 'write',
    'name' => 'search Tenants With Id',
    'description' => 'Searches tenants with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_themes_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchThemesWithId',
    'type' => 'write',
    'name' => 'search Themes With Id',
    'description' => 'Searches themes with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_user_comments_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchUserCommentsWithId',
    'type' => 'write',
    'name' => 'search User Comments With Id',
    'description' => 'Searches user comments with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_users_by_ids_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchUsersByIdsWithId',
    'type' => 'read',
    'name' => 'search Users By Ids With Id',
    'description' => 'Retrieves the users for the given Ids. If any Id is invalid, it is ignored.',
    'icon' => 'ph:key',
  ),
  'fusionauth_search_users_by_query_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchUsersByQueryWithId',
    'type' => 'write',
    'name' => 'search Users By Query With Id',
    'description' => 'Retrieves the users for the given search criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_webhook_event_logs_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchWebhookEventLogsWithId',
    'type' => 'write',
    'name' => 'search Webhook Event Logs With Id',
    'description' => 'Searches the webhook event logs with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_search_webhooks_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSearchWebhooksWithId',
    'type' => 'write',
    'name' => 'search Webhooks With Id',
    'description' => 'Searches webhooks with the specified criteria and pagination.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_email_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendEmailWithId',
    'type' => 'write',
    'name' => 'send Email With Id',
    'description' => 'Send an email using an email template Id. You can optionally provide requestData to access key value pairs in the email template.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_family_request_email_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendFamilyRequestEmailWithId',
    'type' => 'write',
    'name' => 'send Family Request Email With Id',
    'description' => 'Sends out an email to a parent that they need to register and create a family or need to log in and add a child to their existing family.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_passwordless_code_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendPasswordlessCodeWithId',
    'type' => 'write',
    'name' => 'send Passwordless Code With Id',
    'description' => 'Send a passwordless authentication code in an email to complete login.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_two_factor_code_for_enable_disable_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendTwoFactorCodeForEnableDisableWithId',
    'type' => 'write',
    'name' => 'send Two Factor Code For Enable Disable With Id',
    'description' => 'Send a Two Factor authentication code to assist in setting up Two Factor authentication or disabling.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_two_factor_code_for_login_using_method_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendTwoFactorCodeForLoginUsingMethodWithId',
    'type' => 'write',
    'name' => 'send Two Factor Code For Login Using Method With Id',
    'description' => 'Send a Two Factor authentication code to allow the completion of Two Factor authentication.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_send_verify_identity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthSendVerifyIdentityWithId',
    'type' => 'write',
    'name' => 'send Verify Identity With Id',
    'description' => 'Send a verification code using the appropriate transport for the identity type being verified.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_identity_provider_connection_test_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartIdentityProviderConnectionTestWithId',
    'type' => 'write',
    'name' => 'start Identity Provider Connection Test With Id',
    'description' => 'Begins an identity provider connection test.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_identity_provider_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartIdentityProviderLoginWithId',
    'type' => 'write',
    'name' => 'start Identity Provider Login With Id',
    'description' => 'Begins a login request for a 3rd party login that requires user interaction such as HYPR.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_passwordless_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartPasswordlessLoginWithId',
    'type' => 'write',
    'name' => 'start Passwordless Login With Id',
    'description' => 'Start a passwordless login request by generating a passwordless code. This code can be sent to the User using the Send Passwordless Code API or using a mechanism outside of FusionAuth. The passwordless login is completed by using the Passwordless Login API with this code.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_two_factor_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartTwoFactorLoginWithId',
    'type' => 'write',
    'name' => 'start Two Factor Login With Id',
    'description' => 'Start a Two-Factor login request by generating a two-factor identifier. This code can then be sent to the Two Factor Send API (/api/two-factor/send)in order to send a one-time use code to a user. You can also use one-time use code returned to send the code out-of-band. The Two-Factor login is completed by making a request to the Two-Factor Login API (/api/two-factor/login). with the two-factor identifier and the one-time use code. This API is intended to allow you to begin a Two-Factor login out',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_verify_identity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartVerifyIdentityWithId',
    'type' => 'write',
    'name' => 'start Verify Identity With Id',
    'description' => 'Start a verification of an identity by generating a code. This code can be sent to the User using the Verify Send API Verification Code API or using a mechanism outside of FusionAuth. The verification is completed by using the Verify Complete API with this code.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_web_authn_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartWebAuthnLoginWithId',
    'type' => 'write',
    'name' => 'start Web Authn Login With Id',
    'description' => 'Start a WebAuthn authentication ceremony by generating a new challenge for the user',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_start_web_authn_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthStartWebAuthnRegistrationWithId',
    'type' => 'write',
    'name' => 'start Web Authn Registration With Id',
    'description' => 'Start a WebAuthn registration ceremony by generating a new challenge for the user',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_two_factor_login_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthTwoFactorLoginWithId',
    'type' => 'write',
    'name' => 'two Factor Login With Id',
    'description' => 'Complete login using a 2FA challenge',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_apikey_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateApikeyWithId',
    'type' => 'write',
    'name' => 'update APIKey With Id',
    'description' => 'Updates an API key with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_application_role_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateApplicationRoleWithId',
    'type' => 'write',
    'name' => 'update Application Role With Id',
    'description' => 'Updates the application role with the given Id for the application.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_application_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateApplicationWithId',
    'type' => 'write',
    'name' => 'update Application With Id',
    'description' => 'Updates the application with the given Id. OR Reactivates the application with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_connector_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateConnectorWithId',
    'type' => 'write',
    'name' => 'update Connector With Id',
    'description' => 'Updates the connector with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateConsentWithId',
    'type' => 'write',
    'name' => 'update Consent With Id',
    'description' => 'Updates the consent with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_email_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateEmailTemplateWithId',
    'type' => 'write',
    'name' => 'update Email Template With Id',
    'description' => 'Updates the email template with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_entity_type_permission_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateEntityTypePermissionWithId',
    'type' => 'write',
    'name' => 'update Entity Type Permission With Id',
    'description' => 'Updates the permission with the given Id for the entity type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_entity_type_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateEntityTypeWithId',
    'type' => 'write',
    'name' => 'update Entity Type With Id',
    'description' => 'Updates the Entity Type with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_entity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateEntityWithId',
    'type' => 'write',
    'name' => 'update Entity With Id',
    'description' => 'Updates the Entity with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_form_field_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateFormFieldWithId',
    'type' => 'write',
    'name' => 'update Form Field With Id',
    'description' => 'Updates the form field with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_form_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateFormWithId',
    'type' => 'write',
    'name' => 'update Form With Id',
    'description' => 'Updates the form with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_group_members_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateGroupMembersWithId',
    'type' => 'write',
    'name' => 'update Group Members With Id',
    'description' => 'Creates a member in a group.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_group_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateGroupWithId',
    'type' => 'write',
    'name' => 'update Group With Id',
    'description' => 'Updates the group with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_identity_provider_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateIdentityProviderWithId',
    'type' => 'write',
    'name' => 'update Identity Provider With Id',
    'description' => 'Updates the identity provider with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_integrations_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateIntegrationsWithId',
    'type' => 'write',
    'name' => 'update Integrations With Id',
    'description' => 'Updates the available integrations.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_ipaccess_control_list_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateIpaccessControlListWithId',
    'type' => 'write',
    'name' => 'update IPAccess Control List With Id',
    'description' => 'Updates the IP Access Control List with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_key_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateKeyWithId',
    'type' => 'write',
    'name' => 'update Key With Id',
    'description' => 'Updates the key with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_lambda_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateLambdaWithId',
    'type' => 'write',
    'name' => 'update Lambda With Id',
    'description' => 'Updates the lambda with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_message_template_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateMessageTemplateWithId',
    'type' => 'write',
    'name' => 'update Message Template With Id',
    'description' => 'Updates the message template with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_messenger_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateMessengerWithId',
    'type' => 'write',
    'name' => 'update Messenger With Id',
    'description' => 'Updates the messenger with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_oauth_scope_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateOauthScopeWithId',
    'type' => 'write',
    'name' => 'update OAuth Scope With Id',
    'description' => 'Updates the OAuth scope with the given Id for the application.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateRegistrationWithId',
    'type' => 'write',
    'name' => 'update Registration With Id',
    'description' => 'Updates the registration for the user with the given Id and the application defined in the request.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_system_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateSystemConfigurationWithId',
    'type' => 'write',
    'name' => 'update System Configuration With Id',
    'description' => 'Updates the system configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_tenant_manager_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateTenantManagerConfigurationWithId',
    'type' => 'write',
    'name' => 'update Tenant Manager Configuration With Id',
    'description' => 'Updates the Tenant Manager configuration.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_tenant_manager_identity_provider_type_configuration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateTenantManagerIdentityProviderTypeConfigurationWithId',
    'type' => 'write',
    'name' => 'update Tenant Manager Identity Provider Type Configuration With Id',
    'description' => 'Updates the tenant manager identity provider type configuration for the given identity provider type.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_tenant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateTenantWithId',
    'type' => 'write',
    'name' => 'update Tenant With Id',
    'description' => 'Updates the tenant with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_theme_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateThemeWithId',
    'type' => 'write',
    'name' => 'update Theme With Id',
    'description' => 'Updates the theme with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_action_reason_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserActionReasonWithId',
    'type' => 'write',
    'name' => 'update User Action Reason With Id',
    'description' => 'Updates the user action reason with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_action_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserActionWithId',
    'type' => 'write',
    'name' => 'update User Action With Id',
    'description' => 'Updates the user action with the given Id. OR Reactivates the user action with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_consent_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserConsentWithId',
    'type' => 'write',
    'name' => 'update User Consent With Id',
    'description' => 'Updates a single User consent by Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_family_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserFamilyWithId',
    'type' => 'write',
    'name' => 'update User Family With Id',
    'description' => 'Updates a family with a given Id. OR Adds a user to an existing family. The family Id must be specified.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_verify_email' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserVerifyEmail',
    'type' => 'write',
    'name' => 'update User Verify Email',
    'description' => 'Re-sends the verification email to the user. If the Application has configured a specific email template this will be used instead of the tenant configuration. OR Re-sends the verification email to the user. OR Generate a new Email Verification Id to be used with the Verify Email API. This API will not attempt to send an email to the User. This API may be used to collect the verificationId for use with a third party system.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_verify_registration' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserVerifyRegistration',
    'type' => 'write',
    'name' => 'update User Verify Registration',
    'description' => 'Re-sends the application registration verification email to the user. OR Generate a new Application Registration Verification Id to be used with the Verify Registration API. This API will not attempt to send an email to the User. This API may be used to collect the verificationId for use with a third party system.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_user_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateUserWithId',
    'type' => 'write',
    'name' => 'update User With Id',
    'description' => 'Updates the user with the given Id. OR Reactivates the user with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_update_webhook_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpdateWebhookWithId',
    'type' => 'write',
    'name' => 'update Webhook With Id',
    'description' => 'Updates the webhook with the given Id.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_upsert_entity_grant_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthUpsertEntityGrantWithId',
    'type' => 'write',
    'name' => 'upsert Entity Grant With Id',
    'description' => 'Creates or updates an Entity Grant. This is when a User/Entity is granted permissions to an Entity.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_validate_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthValidateJwtwithId',
    'type' => 'read',
    'name' => 'validate JWTWith Id',
    'description' => 'Validates the provided JWT (encoded JWT string) to ensure the token is valid. A valid access token is properly signed and not expired. This API may be used to verify the JWT as well as decode the encoded JWT into human readable identity claims.',
    'icon' => 'ph:key',
  ),
  'fusionauth_vend_jwtwith_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthVendJwtwithId',
    'type' => 'write',
    'name' => 'vend JWTWith Id',
    'description' => 'It\'s a JWT vending machine! Issue a new access token (JWT) with the provided claims in the request. This JWT is not scoped to a tenant or user, it is a free form token that will contain what claims you provide. The iat, exp and jti claims will be added by FusionAuth, all other claims must be provided by the caller. If a TTL is not provided in the request, the TTL will be retrieved from the default Tenant or the Tenant specified on the request either by way of the X-FusionAuth-TenantId request he',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_verify_identity_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthVerifyIdentityWithId',
    'type' => 'write',
    'name' => 'verify Identity With Id',
    'description' => 'Administratively verify a user identity.',
    'icon' => 'ph:pencil-simple',
  ),
  'fusionauth_verify_user_registration_with_id' =>
  array (
    'class' => 'OpenCompany\\Integrations\\FusionAuth\\Tools\\FusionAuthVerifyUserRegistrationWithId',
    'type' => 'write',
    'name' => 'verify User Registration With Id',
    'description' => 'Confirms a user\'s registration. The request body will contain the verificationId. You may also be required to send a one-time use code based upon your configuration. When the application is configured to gate a user until their registration is verified, this procedures requires two values instead of one. The verificationId is a high entropy value and the one-time use code is a low entropy value that is easily entered in a user interactive form. The two values together are able to confirm a user\'',
    'icon' => 'ph:pencil-simple',
  ),
); } public function scriptDocsPath(): ?string { return __DIR__.'/../script-docs/fusionauth.md'; } public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Runtime context from the host. */ private function resolveService(array $context=[]): FusionAuthService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new FusionAuthService(apiKey:$creds->get('fusionauth','api_key','',$account), baseUrl:$creds->get('fusionauth','base_url','https://fusionauth.example.test',$account), tenantId:$creds->get('fusionauth','tenant_id','',$account));} return app(FusionAuthService::class); }
}
