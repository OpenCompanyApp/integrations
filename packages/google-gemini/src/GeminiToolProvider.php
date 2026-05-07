<?php

namespace OpenCompany\Integrations\GoogleGemini;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Gemini.
 *
 * Exposes generated coverage for the official Gemini API v1beta Discovery
 * document, including models, files, caches, batches, corpora, and tuning.
 */
class GeminiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_key','legacy_auth_type'=>'api_key','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Requires a Gemini API key from Google AI Studio or Google Cloud.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-gemini'; }
    public function appMeta(): array { return ['label'=>'Google Gemini','description'=>'Models, generation, embeddings, files, caches, corpora, tuning, batches, generated files, and file search','icon'=>'ph:brain','logo'=>'logos:google-gemini']; }
    public function integrationMeta(): array { return ['name'=>'Google Gemini','description'=>'Generated coverage for Gemini API v1beta: models, generation, embeddings, files, caches, corpora, tuned models, batches, generated files, and file search stores.','icon'=>'ph:brain','logo'=>'logos:google-gemini','category'=>'data','badge'=>'verified','docs_url'=>'https://ai.google.dev/api']; }
    public function configSchema(): array { return [['key'=>'api_key','type'=>'secret','label'=>'API Key','placeholder'=>'Google Gemini API key','hint'=>'Generate an API key in Google AI Studio.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://generativelanguage.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://generativelanguage.googleapis.com']]; }
    /**
     * Verify Google Gemini credentials with a lightweight models endpoint call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $apiKey=(string)($config['api_key']??''); $baseUrl=rtrim((string)($config['url']??'https://generativelanguage.googleapis.com'),'/'); if($apiKey==='') return ['success'=>false,'error'=>'No API key provided.']; try{$response=Http::withHeaders(['x-goog-api-key'=>$apiKey])->acceptJson()->timeout(20)->get($baseUrl.'/v1beta/models', ['pageSize'=>1]); return $response->successful()?['success'=>true,'message'=>'Google Gemini credentials verified.']:['success'=>false,'error'=>'Google Gemini API returned HTTP '.$response->status().'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['api_key'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_gemini_cached_contents_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCachedContentsPatch',
  'type' => 'write',
  'name' => 'Cached Contents Patch',
  'description' => 'Cached Contents Patch (PATCH /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_cached_contents_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCachedContentsCreate',
  'type' => 'write',
  'name' => 'Cached Contents Create',
  'description' => 'Cached Contents Create (POST /v1beta/cachedContents).',
  'icon' => 'ph:brain',
),
        'google_gemini_cached_contents_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCachedContentsGet',
  'type' => 'read',
  'name' => 'Cached Contents Get',
  'description' => 'Cached Contents Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_cached_contents_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCachedContentsList',
  'type' => 'read',
  'name' => 'Cached Contents List',
  'description' => 'Cached Contents List (GET /v1beta/cachedContents).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_cached_contents_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCachedContentsDelete',
  'type' => 'write',
  'name' => 'Cached Contents Delete',
  'description' => 'Cached Contents Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_file_search_stores_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresCreate',
  'type' => 'write',
  'name' => 'File Search Stores Create',
  'description' => 'File Search Stores Create (POST /v1beta/fileSearchStores).',
  'icon' => 'ph:brain',
),
        'google_gemini_file_search_stores_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresGet',
  'type' => 'read',
  'name' => 'File Search Stores Get',
  'description' => 'File Search Stores Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_file_search_stores_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresDelete',
  'type' => 'write',
  'name' => 'File Search Stores Delete',
  'description' => 'File Search Stores Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_file_search_stores_import_file' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresImportFile',
  'type' => 'write',
  'name' => 'File Search Stores Import File',
  'description' => 'File Search Stores Import File (POST /v1beta/{+fileSearchStoreName}:importFile).',
  'icon' => 'ph:brain',
),
        'google_gemini_file_search_stores_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresList',
  'type' => 'read',
  'name' => 'File Search Stores List',
  'description' => 'File Search Stores List (GET /v1beta/fileSearchStores).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_file_search_stores_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresOperationsGet',
  'type' => 'read',
  'name' => 'File Search Stores Operations Get',
  'description' => 'File Search Stores Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_file_search_stores_documents_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresDocumentsDelete',
  'type' => 'write',
  'name' => 'File Search Stores Documents Delete',
  'description' => 'File Search Stores Documents Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_file_search_stores_documents_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresDocumentsGet',
  'type' => 'read',
  'name' => 'File Search Stores Documents Get',
  'description' => 'File Search Stores Documents Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_file_search_stores_documents_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresDocumentsList',
  'type' => 'read',
  'name' => 'File Search Stores Documents List',
  'description' => 'File Search Stores Documents List (GET /v1beta/{+parent}/documents).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_file_search_stores_upload_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFileSearchStoresUploadOperationsGet',
  'type' => 'read',
  'name' => 'File Search Stores Upload Operations Get',
  'description' => 'File Search Stores Upload Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_batches_cancel' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesCancel',
  'type' => 'write',
  'name' => 'Batches Cancel',
  'description' => 'Batches Cancel (POST /v1beta/{+name}:cancel).',
  'icon' => 'ph:brain',
),
        'google_gemini_batches_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesGet',
  'type' => 'read',
  'name' => 'Batches Get',
  'description' => 'Batches Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_batches_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesList',
  'type' => 'read',
  'name' => 'Batches List',
  'description' => 'Batches List (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_batches_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesDelete',
  'type' => 'write',
  'name' => 'Batches Delete',
  'description' => 'Batches Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_batches_update_generate_content_batch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesUpdateGenerateContentBatch',
  'type' => 'write',
  'name' => 'Batches Update Generate Content Batch',
  'description' => 'Batches Update Generate Content Batch (PATCH /v1beta/{+name}:updateGenerateContentBatch).',
  'icon' => 'ph:brain',
),
        'google_gemini_batches_update_embed_content_batch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiBatchesUpdateEmbedContentBatch',
  'type' => 'write',
  'name' => 'Batches Update Embed Content Batch',
  'description' => 'Batches Update Embed Content Batch (PATCH /v1beta/{+name}:updateEmbedContentBatch).',
  'icon' => 'ph:brain',
),
        'google_gemini_dynamic_stream_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiDynamicStreamGenerateContent',
  'type' => 'write',
  'name' => 'Dynamic Stream Generate Content',
  'description' => 'Dynamic Stream Generate Content (POST /v1beta/{+model}:streamGenerateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_dynamic_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiDynamicGenerateContent',
  'type' => 'write',
  'name' => 'Dynamic Generate Content',
  'description' => 'Dynamic Generate Content (POST /v1beta/{+model}:generateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_media_upload' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiMediaUpload',
  'type' => 'write',
  'name' => 'Media Upload',
  'description' => 'Media Upload (POST /v1beta/files).',
  'icon' => 'ph:brain',
),
        'google_gemini_media_upload_to_file_search_store' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiMediaUploadToFileSearchStore',
  'type' => 'write',
  'name' => 'Media Upload To File Search Store',
  'description' => 'Media Upload To File Search Store (POST /v1beta/{+fileSearchStoreName}:uploadToFileSearchStore).',
  'icon' => 'ph:brain',
),
        'google_gemini_corpora_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaList',
  'type' => 'read',
  'name' => 'Corpora List',
  'description' => 'Corpora List (GET /v1beta/corpora).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_corpora_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaCreate',
  'type' => 'write',
  'name' => 'Corpora Create',
  'description' => 'Corpora Create (POST /v1beta/corpora).',
  'icon' => 'ph:brain',
),
        'google_gemini_corpora_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaGet',
  'type' => 'read',
  'name' => 'Corpora Get',
  'description' => 'Corpora Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_corpora_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaDelete',
  'type' => 'write',
  'name' => 'Corpora Delete',
  'description' => 'Corpora Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_corpora_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaOperationsGet',
  'type' => 'read',
  'name' => 'Corpora Operations Get',
  'description' => 'Corpora Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_corpora_permissions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaPermissionsDelete',
  'type' => 'write',
  'name' => 'Corpora Permissions Delete',
  'description' => 'Corpora Permissions Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_corpora_permissions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaPermissionsList',
  'type' => 'read',
  'name' => 'Corpora Permissions List',
  'description' => 'Corpora Permissions List (GET /v1beta/{+parent}/permissions).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_corpora_permissions_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaPermissionsCreate',
  'type' => 'write',
  'name' => 'Corpora Permissions Create',
  'description' => 'Corpora Permissions Create (POST /v1beta/{+parent}/permissions).',
  'icon' => 'ph:brain',
),
        'google_gemini_corpora_permissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaPermissionsGet',
  'type' => 'read',
  'name' => 'Corpora Permissions Get',
  'description' => 'Corpora Permissions Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_corpora_permissions_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiCorporaPermissionsPatch',
  'type' => 'write',
  'name' => 'Corpora Permissions Patch',
  'description' => 'Corpora Permissions Patch (PATCH /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_files_register' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFilesRegister',
  'type' => 'write',
  'name' => 'Files Register',
  'description' => 'Files Register (POST /v1beta/files:register).',
  'icon' => 'ph:brain',
),
        'google_gemini_files_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFilesList',
  'type' => 'read',
  'name' => 'Files List',
  'description' => 'Files List (GET /v1beta/files).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_files_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFilesGet',
  'type' => 'read',
  'name' => 'Files Get',
  'description' => 'Files Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_files_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiFilesDelete',
  'type' => 'write',
  'name' => 'Files Delete',
  'description' => 'Files Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_stream_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsStreamGenerateContent',
  'type' => 'write',
  'name' => 'Tuned Models Stream Generate Content',
  'description' => 'Tuned Models Stream Generate Content (POST /v1beta/{+model}:streamGenerateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_batch_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsBatchGenerateContent',
  'type' => 'write',
  'name' => 'Tuned Models Batch Generate Content',
  'description' => 'Tuned Models Batch Generate Content (POST /v1beta/{+model}:batchGenerateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsGet',
  'type' => 'read',
  'name' => 'Tuned Models Get',
  'description' => 'Tuned Models Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsCreate',
  'type' => 'write',
  'name' => 'Tuned Models Create',
  'description' => 'Tuned Models Create (POST /v1beta/tunedModels).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsList',
  'type' => 'read',
  'name' => 'Tuned Models List',
  'description' => 'Tuned Models List (GET /v1beta/tunedModels).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_generate_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsGenerateText',
  'type' => 'write',
  'name' => 'Tuned Models Generate Text',
  'description' => 'Tuned Models Generate Text (POST /v1beta/{+model}:generateText).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsDelete',
  'type' => 'write',
  'name' => 'Tuned Models Delete',
  'description' => 'Tuned Models Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPatch',
  'type' => 'write',
  'name' => 'Tuned Models Patch',
  'description' => 'Tuned Models Patch (PATCH /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_async_batch_embed_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsAsyncBatchEmbedContent',
  'type' => 'write',
  'name' => 'Tuned Models Async Batch Embed Content',
  'description' => 'Tuned Models Async Batch Embed Content (POST /v1beta/{+model}:asyncBatchEmbedContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsGenerateContent',
  'type' => 'write',
  'name' => 'Tuned Models Generate Content',
  'description' => 'Tuned Models Generate Content (POST /v1beta/{+model}:generateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_transfer_ownership' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsTransferOwnership',
  'type' => 'write',
  'name' => 'Tuned Models Transfer Ownership',
  'description' => 'Tuned Models Transfer Ownership (POST /v1beta/{+name}:transferOwnership).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_operations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsOperationsList',
  'type' => 'read',
  'name' => 'Tuned Models Operations List',
  'description' => 'Tuned Models Operations List (GET /v1beta/{+name}/operations).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsOperationsGet',
  'type' => 'read',
  'name' => 'Tuned Models Operations Get',
  'description' => 'Tuned Models Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_permissions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPermissionsDelete',
  'type' => 'write',
  'name' => 'Tuned Models Permissions Delete',
  'description' => 'Tuned Models Permissions Delete (DELETE /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_permissions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPermissionsList',
  'type' => 'read',
  'name' => 'Tuned Models Permissions List',
  'description' => 'Tuned Models Permissions List (GET /v1beta/{+parent}/permissions).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_permissions_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPermissionsCreate',
  'type' => 'write',
  'name' => 'Tuned Models Permissions Create',
  'description' => 'Tuned Models Permissions Create (POST /v1beta/{+parent}/permissions).',
  'icon' => 'ph:brain',
),
        'google_gemini_tuned_models_permissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPermissionsGet',
  'type' => 'read',
  'name' => 'Tuned Models Permissions Get',
  'description' => 'Tuned Models Permissions Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_tuned_models_permissions_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiTunedModelsPermissionsPatch',
  'type' => 'write',
  'name' => 'Tuned Models Permissions Patch',
  'description' => 'Tuned Models Permissions Patch (PATCH /v1beta/{+name}).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsGenerateContent',
  'type' => 'write',
  'name' => 'Models Generate Content',
  'description' => 'Models Generate Content (POST /v1beta/{+model}:generateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_generate_message' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsGenerateMessage',
  'type' => 'write',
  'name' => 'Models Generate Message',
  'description' => 'Models Generate Message (POST /v1beta/{+model}:generateMessage).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_predict' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsPredict',
  'type' => 'write',
  'name' => 'Models Predict',
  'description' => 'Models Predict (POST /v1beta/{+model}:predict).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_embed_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsEmbedContent',
  'type' => 'write',
  'name' => 'Models Embed Content',
  'description' => 'Models Embed Content (POST /v1beta/{+model}:embedContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsList',
  'type' => 'read',
  'name' => 'Models List',
  'description' => 'Models List (GET /v1beta/models).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_models_batch_embed_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsBatchEmbedText',
  'type' => 'write',
  'name' => 'Models Batch Embed Text',
  'description' => 'Models Batch Embed Text (POST /v1beta/{+model}:batchEmbedText).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_async_batch_embed_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsAsyncBatchEmbedContent',
  'type' => 'write',
  'name' => 'Models Async Batch Embed Content',
  'description' => 'Models Async Batch Embed Content (POST /v1beta/{+model}:asyncBatchEmbedContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_count_message_tokens' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsCountMessageTokens',
  'type' => 'write',
  'name' => 'Models Count Message Tokens',
  'description' => 'Models Count Message Tokens (POST /v1beta/{+model}:countMessageTokens).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_count_tokens' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsCountTokens',
  'type' => 'write',
  'name' => 'Models Count Tokens',
  'description' => 'Models Count Tokens (POST /v1beta/{+model}:countTokens).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_predict_long_running' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsPredictLongRunning',
  'type' => 'write',
  'name' => 'Models Predict Long Running',
  'description' => 'Models Predict Long Running (POST /v1beta/{+model}:predictLongRunning).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_generate_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsGenerateText',
  'type' => 'write',
  'name' => 'Models Generate Text',
  'description' => 'Models Generate Text (POST /v1beta/{+model}:generateText).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_count_text_tokens' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsCountTextTokens',
  'type' => 'write',
  'name' => 'Models Count Text Tokens',
  'description' => 'Models Count Text Tokens (POST /v1beta/{+model}:countTextTokens).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_embed_text' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsEmbedText',
  'type' => 'write',
  'name' => 'Models Embed Text',
  'description' => 'Models Embed Text (POST /v1beta/{+model}:embedText).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_generate_answer' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsGenerateAnswer',
  'type' => 'write',
  'name' => 'Models Generate Answer',
  'description' => 'Models Generate Answer (POST /v1beta/{+model}:generateAnswer).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_batch_embed_contents' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsBatchEmbedContents',
  'type' => 'write',
  'name' => 'Models Batch Embed Contents',
  'description' => 'Models Batch Embed Contents (POST /v1beta/{+model}:batchEmbedContents).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_stream_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsStreamGenerateContent',
  'type' => 'write',
  'name' => 'Models Stream Generate Content',
  'description' => 'Models Stream Generate Content (POST /v1beta/{+model}:streamGenerateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_batch_generate_content' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsBatchGenerateContent',
  'type' => 'write',
  'name' => 'Models Batch Generate Content',
  'description' => 'Models Batch Generate Content (POST /v1beta/{+model}:batchGenerateContent).',
  'icon' => 'ph:brain',
),
        'google_gemini_models_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsGet',
  'type' => 'read',
  'name' => 'Models Get',
  'description' => 'Models Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_models_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsOperationsGet',
  'type' => 'read',
  'name' => 'Models Operations Get',
  'description' => 'Models Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_models_operations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiModelsOperationsList',
  'type' => 'read',
  'name' => 'Models Operations List',
  'description' => 'Models Operations List (GET /v1beta/{+name}/operations).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_generated_files_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiGeneratedFilesList',
  'type' => 'read',
  'name' => 'Generated Files List',
  'description' => 'Generated Files List (GET /v1beta/generatedFiles).',
  'icon' => 'ph:magnifying-glass',
),
        'google_gemini_generated_files_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleGemini\\Tools\\GeminiGeneratedFilesOperationsGet',
  'type' => 'read',
  'name' => 'Generated Files Operations Get',
  'description' => 'Generated Files Operations Get (GET /v1beta/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GeminiService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GeminiService(apiKey: $creds->get('google-gemini','api_key','',$account), baseUrl: $creds->get('google-gemini','url','https://generativelanguage.googleapis.com',$account));} return app(GeminiService::class); }
    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-gemini.md'; }
}
