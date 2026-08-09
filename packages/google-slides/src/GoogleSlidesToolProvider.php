<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Slides.
 *
 * Exposes generated coverage for the official Google Slides API v1 Discovery
 * document, including presentations, pages, thumbnails, and batch updates.
 */
class GoogleSlidesToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Slides API scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-slides'; }
    public function appMeta(): array { return ['label'=>'Google Slides','description'=>'Presentations, batch updates, pages, and thumbnails','icon'=>'ph:presentation-chart','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Slides','description'=>'Generated coverage for the Google Slides API v1: presentations, batch updates, pages, and thumbnails.','icon'=>'ph:presentation-chart','logo'=>'logos:google-icon','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developers.google.com/workspace/slides/api/reference/rest']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Slides API scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://slides.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://slides.googleapis.com']]; }
    /**
     * Verify Google Slides credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); return $accessToken==='' ? ['success'=>false,'error'=>'No access token provided.'] : ['success'=>true,'message'=>'Google Slides token is present. Use a presentation-specific read tool for a live check.']; }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_slides_presentations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSlides\\Tools\\GoogleSlidesPresentationsGet',
  'type' => 'read',
  'name' => 'Presentations Get',
  'description' => 'Presentations Get (GET /v1/presentations/{+presentationId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_slides_presentations_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSlides\\Tools\\GoogleSlidesPresentationsCreate',
  'type' => 'write',
  'name' => 'Presentations Create',
  'description' => 'Presentations Create (POST /v1/presentations).',
  'icon' => 'ph:presentation-chart',
),
        'google_slides_presentations_batch_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSlides\\Tools\\GoogleSlidesPresentationsBatchUpdate',
  'type' => 'write',
  'name' => 'Presentations Batch Update',
  'description' => 'Presentations Batch Update (POST /v1/presentations/{presentationId}:batchUpdate).',
  'icon' => 'ph:presentation-chart',
),
        'google_slides_presentations_pages_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSlides\\Tools\\GoogleSlidesPresentationsPagesGet',
  'type' => 'read',
  'name' => 'Presentations Pages Get',
  'description' => 'Presentations Pages Get (GET /v1/presentations/{presentationId}/pages/{pageObjectId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_slides_presentations_pages_get_thumbnail' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSlides\\Tools\\GoogleSlidesPresentationsPagesGetThumbnail',
  'type' => 'read',
  'name' => 'Presentations Pages Get Thumbnail',
  'description' => 'Presentations Pages Get Thumbnail (GET /v1/presentations/{presentationId}/pages/{pageObjectId}/thumbnail).',
  'icon' => 'ph:magnifying-glass',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleSlidesService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleSlidesService(accessToken: $creds->get('google-slides','access_token','',$account), baseUrl: $creds->get('google-slides','url','https://slides.googleapis.com',$account));} return app(GoogleSlidesService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-slides.md'; }
}
