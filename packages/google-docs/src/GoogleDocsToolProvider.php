<?php

namespace OpenCompany\Integrations\GoogleDocs;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Docs.
 *
 * Exposes generated coverage for the official Google Docs API v1 Discovery
 * document, including document create, get, and batch update.
 */
class GoogleDocsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Docs API scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-docs'; }
    public function appMeta(): array { return ['label'=>'Google Docs','description'=>'Document create, get, and batch update','icon'=>'ph:file-doc','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Docs','description'=>'Generated coverage for the Google Docs API v1: document create, get, and batchUpdate.','icon'=>'ph:file-doc','logo'=>'logos:google-icon','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developers.google.com/workspace/docs/api/reference/rest']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Docs API scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://docs.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://docs.googleapis.com']]; }
    /**
     * Verify Google Docs credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); return $accessToken==='' ? ['success'=>false,'error'=>'No access token provided.'] : ['success'=>true,'message'=>'Google Docs token is present. Use a document-specific read tool for a live check.']; }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_docs_documents_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDocs\\Tools\\GoogleDocsDocumentsGet',
  'type' => 'read',
  'name' => 'Documents Get',
  'description' => 'Documents Get (GET /v1/documents/{documentId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_docs_documents_batch_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDocs\\Tools\\GoogleDocsDocumentsBatchUpdate',
  'type' => 'write',
  'name' => 'Documents Batch Update',
  'description' => 'Documents Batch Update (POST /v1/documents/{documentId}:batchUpdate).',
  'icon' => 'ph:file-doc',
),
        'google_docs_documents_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDocs\\Tools\\GoogleDocsDocumentsCreate',
  'type' => 'write',
  'name' => 'Documents Create',
  'description' => 'Documents Create (POST /v1/documents).',
  'icon' => 'ph:file-doc',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleDocsService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleDocsService(accessToken: $creds->get('google-docs','access_token','',$account), baseUrl: $creds->get('google-docs','url','https://docs.googleapis.com',$account));} return app(GoogleDocsService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-docs.md'; }
}
