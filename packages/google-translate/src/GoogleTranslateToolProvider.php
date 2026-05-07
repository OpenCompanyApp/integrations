<?php

namespace OpenCompany\Integrations\GoogleTranslate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Translate.
 *
 * Exposes generated coverage for the official Cloud Translation API v3
 * Discovery document, including translation, glossaries, datasets, and models.
 */
class GoogleTranslateToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Cloud Translation scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-translate'; }
    public function appMeta(): array { return ['label'=>'Google Translate','description'=>'Translation, detection, documents, glossaries, datasets, models, adaptive MT, and operations','icon'=>'ph:translate','logo'=>'logos:google-icon']; }
    public function integrationMeta(): array { return ['name'=>'Google Translate','description'=>'Generated coverage for the Cloud Translation API v3: translation, detection, documents, glossaries, datasets, models, adaptive MT, and operations.','icon'=>'ph:translate','logo'=>'logos:google-icon','category'=>'data','badge'=>'verified','docs_url'=>'https://cloud.google.com/translate/docs/reference/rest']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Cloud Translation scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://translate.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://translate.googleapis.com']]; }
    /**
     * Verify Google Translate credentials with token-presence only.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); return $accessToken==='' ? ['success'=>false,'error'=>'No access token provided.'] : ['success'=>true,'message'=>'Google Translate token is present. Use a project-specific read tool for a live check.']; }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_translate_projects_get_supported_languages' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsGetSupportedLanguages',
  'type' => 'read',
  'name' => 'Projects Get Supported Languages',
  'description' => 'Projects Get Supported Languages (GET /v3/{+parent}/supportedLanguages).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_detect_language' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsDetectLanguage',
  'type' => 'write',
  'name' => 'Projects Detect Language',
  'description' => 'Projects Detect Language (POST /v3/{+parent}:detectLanguage).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_translate_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsTranslateText',
  'type' => 'write',
  'name' => 'Projects Translate Text',
  'description' => 'Projects Translate Text (POST /v3/{+parent}:translateText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_romanize_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsRomanizeText',
  'type' => 'write',
  'name' => 'Projects Romanize Text',
  'description' => 'Projects Romanize Text (POST /v3/{+parent}:romanizeText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_refine_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsRefineText',
  'type' => 'write',
  'name' => 'Projects Locations Refine Text',
  'description' => 'Projects Locations Refine Text (POST /v3/{+parent}:refineText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGet',
  'type' => 'read',
  'name' => 'Projects Locations Get',
  'description' => 'Projects Locations Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_translate_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsTranslateText',
  'type' => 'write',
  'name' => 'Projects Locations Translate Text',
  'description' => 'Projects Locations Translate Text (POST /v3/{+parent}:translateText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_translate' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtTranslate',
  'type' => 'write',
  'name' => 'Projects Locations Adaptive Mt Translate',
  'description' => 'Projects Locations Adaptive Mt Translate (POST /v3/{+parent}:adaptiveMtTranslate).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsList',
  'type' => 'read',
  'name' => 'Projects Locations List',
  'description' => 'Projects Locations List (GET /v3/{+name}/locations).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_translate_document' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsTranslateDocument',
  'type' => 'write',
  'name' => 'Projects Locations Translate Document',
  'description' => 'Projects Locations Translate Document (POST /v3/{+parent}:translateDocument).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_get_supported_languages' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGetSupportedLanguages',
  'type' => 'read',
  'name' => 'Projects Locations Get Supported Languages',
  'description' => 'Projects Locations Get Supported Languages (GET /v3/{+parent}/supportedLanguages).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_batch_translate_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsBatchTranslateText',
  'type' => 'write',
  'name' => 'Projects Locations Batch Translate Text',
  'description' => 'Projects Locations Batch Translate Text (POST /v3/{+parent}:batchTranslateText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_detect_language' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDetectLanguage',
  'type' => 'write',
  'name' => 'Projects Locations Detect Language',
  'description' => 'Projects Locations Detect Language (POST /v3/{+parent}:detectLanguage).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_batch_translate_document' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsBatchTranslateDocument',
  'type' => 'write',
  'name' => 'Projects Locations Batch Translate Document',
  'description' => 'Projects Locations Batch Translate Document (POST /v3/{+parent}:batchTranslateDocument).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_romanize_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsRomanizeText',
  'type' => 'write',
  'name' => 'Projects Locations Romanize Text',
  'description' => 'Projects Locations Romanize Text (POST /v3/{+parent}:romanizeText).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_models_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsModelsDelete',
  'type' => 'write',
  'name' => 'Projects Locations Models Delete',
  'description' => 'Projects Locations Models Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_models_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsModelsList',
  'type' => 'read',
  'name' => 'Projects Locations Models List',
  'description' => 'Projects Locations Models List (GET /v3/{+parent}/models).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_models_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsModelsGet',
  'type' => 'read',
  'name' => 'Projects Locations Models Get',
  'description' => 'Projects Locations Models Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_models_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsModelsCreate',
  'type' => 'write',
  'name' => 'Projects Locations Models Create',
  'description' => 'Projects Locations Models Create (POST /v3/{+parent}/models).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsOperationsGet',
  'type' => 'read',
  'name' => 'Projects Locations Operations Get',
  'description' => 'Projects Locations Operations Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_operations_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsOperationsDelete',
  'type' => 'write',
  'name' => 'Projects Locations Operations Delete',
  'description' => 'Projects Locations Operations Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_operations_cancel' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsOperationsCancel',
  'type' => 'write',
  'name' => 'Projects Locations Operations Cancel',
  'description' => 'Projects Locations Operations Cancel (POST /v3/{+name}:cancel).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_operations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsOperationsList',
  'type' => 'read',
  'name' => 'Projects Locations Operations List',
  'description' => 'Projects Locations Operations List (GET /v3/{+name}/operations).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_operations_wait' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsOperationsWait',
  'type' => 'write',
  'name' => 'Projects Locations Operations Wait',
  'description' => 'Projects Locations Operations Wait (POST /v3/{+name}:wait).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_datasets_import_data' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsImportData',
  'type' => 'write',
  'name' => 'Projects Locations Datasets Import Data',
  'description' => 'Projects Locations Datasets Import Data (POST /v3/{+dataset}:importData).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_datasets_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsCreate',
  'type' => 'write',
  'name' => 'Projects Locations Datasets Create',
  'description' => 'Projects Locations Datasets Create (POST /v3/{+parent}/datasets).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_datasets_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsDelete',
  'type' => 'write',
  'name' => 'Projects Locations Datasets Delete',
  'description' => 'Projects Locations Datasets Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_datasets_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsGet',
  'type' => 'read',
  'name' => 'Projects Locations Datasets Get',
  'description' => 'Projects Locations Datasets Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_datasets_export_data' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsExportData',
  'type' => 'write',
  'name' => 'Projects Locations Datasets Export Data',
  'description' => 'Projects Locations Datasets Export Data (POST /v3/{+dataset}:exportData).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_datasets_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsList',
  'type' => 'read',
  'name' => 'Projects Locations Datasets List',
  'description' => 'Projects Locations Datasets List (GET /v3/{+parent}/datasets).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_datasets_examples_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsDatasetsExamplesList',
  'type' => 'read',
  'name' => 'Projects Locations Datasets Examples List',
  'description' => 'Projects Locations Datasets Examples List (GET /v3/{+parent}/examples).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_glossaries_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesPatch',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Patch',
  'description' => 'Projects Locations Glossaries Patch (PATCH /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_glossaries_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesList',
  'type' => 'read',
  'name' => 'Projects Locations Glossaries List',
  'description' => 'Projects Locations Glossaries List (GET /v3/{+parent}/glossaries).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_glossaries_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesCreate',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Create',
  'description' => 'Projects Locations Glossaries Create (POST /v3/{+parent}/glossaries).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_glossaries_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGet',
  'type' => 'read',
  'name' => 'Projects Locations Glossaries Get',
  'description' => 'Projects Locations Glossaries Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_glossaries_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesDelete',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Delete',
  'description' => 'Projects Locations Glossaries Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_glossaries_glossary_entries_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesGet',
  'type' => 'read',
  'name' => 'Projects Locations Glossaries Glossary Entries Get',
  'description' => 'Projects Locations Glossaries Glossary Entries Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_glossaries_glossary_entries_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesDelete',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Glossary Entries Delete',
  'description' => 'Projects Locations Glossaries Glossary Entries Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_glossaries_glossary_entries_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesCreate',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Glossary Entries Create',
  'description' => 'Projects Locations Glossaries Glossary Entries Create (POST /v3/{+parent}/glossaryEntries).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_glossaries_glossary_entries_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesList',
  'type' => 'read',
  'name' => 'Projects Locations Glossaries Glossary Entries List',
  'description' => 'Projects Locations Glossaries Glossary Entries List (GET /v3/{+parent}/glossaryEntries).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_glossaries_glossary_entries_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesPatch',
  'type' => 'write',
  'name' => 'Projects Locations Glossaries Glossary Entries Patch',
  'description' => 'Projects Locations Glossaries Glossary Entries Patch (PATCH /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_datasets_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsList',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets List',
  'description' => 'Projects Locations Adaptive Mt Datasets List (GET /v3/{+parent}/adaptiveMtDatasets).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_adaptive_mt_datasets_import_adaptive_mt_file' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsImportAdaptiveMtFile',
  'type' => 'write',
  'name' => 'Projects Locations Adaptive Mt Datasets Import Adaptive Mt File',
  'description' => 'Projects Locations Adaptive Mt Datasets Import Adaptive Mt File (POST /v3/{+parent}:importAdaptiveMtFile).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_datasets_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsCreate',
  'type' => 'write',
  'name' => 'Projects Locations Adaptive Mt Datasets Create',
  'description' => 'Projects Locations Adaptive Mt Datasets Create (POST /v3/{+parent}/adaptiveMtDatasets).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_datasets_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsDelete',
  'type' => 'write',
  'name' => 'Projects Locations Adaptive Mt Datasets Delete',
  'description' => 'Projects Locations Adaptive Mt Datasets Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_datasets_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsGet',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets Get',
  'description' => 'Projects Locations Adaptive Mt Datasets Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_sentences_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtSentencesList',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Sentences List',
  'description' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Sentences List (GET /v3/{+parent}/adaptiveMtSentences).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesDelete',
  'type' => 'write',
  'name' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Delete',
  'description' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Delete (DELETE /v3/{+name}).',
  'icon' => 'ph:translate',
),
        'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesGet',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Get',
  'description' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Get (GET /v3/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesList',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files List',
  'description' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files List (GET /v3/{+parent}/adaptiveMtFiles).',
  'icon' => 'ph:magnifying-glass',
),
        'google_translate_projects_locations_adaptive_mt_datasets_adaptive_mt_files_adaptive_mt_sentences_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTranslate\\Tools\\GoogleTranslateProjectsLocationsAdaptiveMtDatasetsAdaptiveMtFilesAdaptiveMtSentencesList',
  'type' => 'read',
  'name' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Adaptive Mt Sentences List',
  'description' => 'Projects Locations Adaptive Mt Datasets Adaptive Mt Files Adaptive Mt Sentences List (GET /v3/{+parent}/adaptiveMtSentences).',
  'icon' => 'ph:magnifying-glass',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleTranslateService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleTranslateService(accessToken: $creds->get('google-translate','access_token','',$account), baseUrl: $creds->get('google-translate','url','https://translate.googleapis.com',$account));} return app(GoogleTranslateService::class); }
    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-translate.md'; }
}
