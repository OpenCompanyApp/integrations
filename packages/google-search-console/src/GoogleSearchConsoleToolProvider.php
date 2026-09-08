<?php

namespace OpenCompany\Integrations\GoogleSearchConsole;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Search Console.
 *
 * Exposes generated coverage for the official Search Console API Discovery
 * document, including sites, sitemaps, search analytics, and URL inspection.
 */
class GoogleSearchConsoleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Search Console scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-search-console'; }
    public function appMeta(): array { return ['label'=>'Google Search Console','description'=>'Sites, sitemaps, search analytics, URL inspection, and mobile friendly tests','icon'=>'ph:chart-line-up','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Search Console','description'=>'Generated coverage for the Google Search Console API v1: sites, sitemaps, search analytics, URL inspection, and mobile friendly tests.','icon'=>'ph:chart-line-up','logo'=>'logos:google-icon','category'=>'analytics','badge'=>'verified','docs_url'=>'https://developers.google.com/webmaster-tools/v1/api_reference_index']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Search Console scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://searchconsole.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://searchconsole.googleapis.com']]; }
    /**
     * Verify Google Search Console credentials with a lightweight sites list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://searchconsole.googleapis.com'),'/'); if($accessToken==='') return ['success'=>false,'error'=>'No access token provided.']; try{$response=Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/webmasters/v3/sites'); return $response->successful()?['success'=>true,'message'=>'Google Search Console credentials verified.']:['success'=>false,'error'=>'Google Search Console API returned HTTP '.$response->status().'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_search_console_sitemaps_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitemapsList',
  'type' => 'read',
  'name' => 'Sitemaps List',
  'description' => 'Sitemaps List (GET /webmasters/v3/sites/{siteUrl}/sitemaps).',
  'icon' => 'ph:magnifying-glass',
),
        'google_search_console_sitemaps_submit' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitemapsSubmit',
  'type' => 'write',
  'name' => 'Sitemaps Submit',
  'description' => 'Sitemaps Submit (PUT /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_sitemaps_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitemapsDelete',
  'type' => 'write',
  'name' => 'Sitemaps Delete',
  'description' => 'Sitemaps Delete (DELETE /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_sitemaps_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitemapsGet',
  'type' => 'read',
  'name' => 'Sitemaps Get',
  'description' => 'Sitemaps Get (GET /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_search_console_url_inspection_index_inspect' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleUrlInspectionIndexInspect',
  'type' => 'write',
  'name' => 'Url Inspection Index Inspect',
  'description' => 'Url Inspection Index Inspect (POST /v1/urlInspection/index:inspect).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_sites_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitesList',
  'type' => 'read',
  'name' => 'Sites List',
  'description' => 'Sites List (GET /webmasters/v3/sites).',
  'icon' => 'ph:magnifying-glass',
),
        'google_search_console_sites_add' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitesAdd',
  'type' => 'write',
  'name' => 'Sites Add',
  'description' => 'Sites Add (PUT /webmasters/v3/sites/{siteUrl}).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_sites_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitesGet',
  'type' => 'read',
  'name' => 'Sites Get',
  'description' => 'Sites Get (GET /webmasters/v3/sites/{siteUrl}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_search_console_sites_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSitesDelete',
  'type' => 'write',
  'name' => 'Sites Delete',
  'description' => 'Sites Delete (DELETE /webmasters/v3/sites/{siteUrl}).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_url_testing_tools_mobile_friendly_test_run' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleUrlTestingToolsMobileFriendlyTestRun',
  'type' => 'write',
  'name' => 'Url Testing Tools Mobile Friendly Test Run',
  'description' => 'Url Testing Tools Mobile Friendly Test Run (POST /v1/urlTestingTools/mobileFriendlyTest:run).',
  'icon' => 'ph:chart-line-up',
),
        'google_search_console_searchanalytics_query' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleSearchConsole\\Tools\\GoogleSearchConsoleSearchanalyticsQuery',
  'type' => 'write',
  'name' => 'Searchanalytics Query',
  'description' => 'Searchanalytics Query (POST /webmasters/v3/sites/{siteUrl}/searchAnalytics/query).',
  'icon' => 'ph:chart-line-up',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleSearchConsoleService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleSearchConsoleService(accessToken: $creds->get('google-search-console','access_token','',$account), baseUrl: $creds->get('google-search-console','url','https://searchconsole.googleapis.com',$account));} return app(GoogleSearchConsoleService::class); }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-search-console.md'; }
}
