<?php

namespace OpenCompany\Integrations\GoogleForms;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Forms.
 *
 * Exposes generated coverage for the official Google Forms API v1 Discovery
 * document, including forms, responses, publish settings, and watches.
 */
class GoogleFormsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Forms API scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]];
    }

    public function appName(): string { return 'google-forms'; }
    public function appMeta(): array { return ['label'=>'Google Forms','description'=>'Forms, responses, batch updates, publish settings, and watches','icon'=>'ph:clipboard-text','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Forms','description'=>'Generated coverage for the Google Forms API v1: forms, responses, batch updates, publish settings, and watches.','icon'=>'ph:clipboard-text','logo'=>'logos:google-icon','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developers.google.com/workspace/forms/api/reference/rest']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Forms API scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://forms.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://forms.googleapis.com']]; }

    /**
     * Verify Google Forms credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken=(string)($config['access_token']??'');
        return $accessToken==='' ? ['success'=>false,'error'=>'No access token provided.'] : ['success'=>true,'message'=>'Google Forms token is present. Use a form-specific read tool for a live check.'];
    }

    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_forms_forms_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsCreate',
  'type' => 'write',
  'name' => 'Forms Create',
  'description' => 'Forms Create (POST /v1/forms).',
  'icon' => 'ph:clipboard-text',
),
            'google_forms_forms_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsGet',
  'type' => 'read',
  'name' => 'Forms Get',
  'description' => 'Forms Get (GET /v1/forms/{formId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_forms_forms_set_publish_settings' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsSetPublishSettings',
  'type' => 'write',
  'name' => 'Forms Set Publish Settings',
  'description' => 'Forms Set Publish Settings (POST /v1/forms/{formId}:setPublishSettings).',
  'icon' => 'ph:clipboard-text',
),
            'google_forms_forms_batch_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsBatchUpdate',
  'type' => 'write',
  'name' => 'Forms Batch Update',
  'description' => 'Forms Batch Update (POST /v1/forms/{formId}:batchUpdate).',
  'icon' => 'ph:clipboard-text',
),
            'google_forms_forms_responses_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsResponsesList',
  'type' => 'read',
  'name' => 'Forms Responses List',
  'description' => 'Forms Responses List (GET /v1/forms/{formId}/responses).',
  'icon' => 'ph:magnifying-glass',
),
            'google_forms_forms_responses_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsResponsesGet',
  'type' => 'read',
  'name' => 'Forms Responses Get',
  'description' => 'Forms Responses Get (GET /v1/forms/{formId}/responses/{responseId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_forms_forms_watches_renew' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsWatchesRenew',
  'type' => 'write',
  'name' => 'Forms Watches Renew',
  'description' => 'Forms Watches Renew (POST /v1/forms/{formId}/watches/{watchId}:renew).',
  'icon' => 'ph:clipboard-text',
),
            'google_forms_forms_watches_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsWatchesCreate',
  'type' => 'write',
  'name' => 'Forms Watches Create',
  'description' => 'Forms Watches Create (POST /v1/forms/{formId}/watches).',
  'icon' => 'ph:clipboard-text',
),
            'google_forms_forms_watches_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsWatchesList',
  'type' => 'read',
  'name' => 'Forms Watches List',
  'description' => 'Forms Watches List (GET /v1/forms/{formId}/watches).',
  'icon' => 'ph:magnifying-glass',
),
            'google_forms_forms_watches_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleForms\\Tools\\GoogleFormsFormsWatchesDelete',
  'type' => 'write',
  'name' => 'Forms Watches Delete',
  'description' => 'Forms Watches Delete (DELETE /v1/forms/{formId}/watches/{watchId}).',
  'icon' => 'ph:clipboard-text',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Forms tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleFormsService
    {
        $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleFormsService(accessToken: $creds->get('google-forms','access_token','',$account), baseUrl: $creds->get('google-forms','url','https://forms.googleapis.com',$account));}
        return app(GoogleFormsService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-forms.md'; }
}
