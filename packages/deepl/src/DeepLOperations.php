<?php

namespace OpenCompany\Integrations\DeepL;

/**
 * Generated metadata for official DeepL OpenAPI operations.
 *
 * Source: https://raw.githubusercontent.com/DeepLcom/openapi/main/openapi.yaml
 */
class DeepLOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'deepl_translate_text' =>
  array (
    'slug' => 'deepl_translate_text',
    'class' => 'DeepLTranslateText',
    'method' => 'POST',
    'path' => '/v2/translate',
    'operation_id' => 'translateText',
    'name' => 'Request Translation',
    'description' => 'The translate function. The total request body size must not exceed 128 KiB (128 * 1024 bytes). Please split up your text into multiple calls if it exceeds this limit.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_translate_document' =>
  array (
    'slug' => 'deepl_translate_document',
    'class' => 'DeepLTranslateDocument',
    'method' => 'POST',
    'path' => '/v2/document',
    'operation_id' => 'translateDocument',
    'name' => 'Upload and Translate a Document',
    'description' => 'This call uploads a document and queues it for translation. The call returns once the upload is complete, returning a document ID and key which can be used to query the translation statushttps://www.deepl.com/docs-api/documents/get-document-status and to download the translated documenthttps://www.deepl.com/docs-api/documents/download-document once translation is complete. Because the request includes a file upload, it must be an HTTP POST request with content type multipart/form-data. Please be aware that the uploaded document is automatically removed from the server once the translated document has been downloaded. You have to upload the document again in order to restart the translation. The maximum upload limit for documents is available herehttps://support.deepl.com/hc/articles/360020582359-Document-formats and may vary based on API plan and document type. You may specify the glossary to use for the document translation using the glossaryid parameter. Important: This requires the sourcelang parameter to be set and the language pair of the glossary has to match the language pair of the request.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'multipart/form-data',
      ),
      'default_content_type' => 'multipart/form-data',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_get_document_status' =>
  array (
    'slug' => 'deepl_get_document_status',
    'class' => 'DeepLGetDocumentStatus',
    'method' => 'POST',
    'path' => '/v2/document/{document_id}',
    'operation_id' => 'getDocumentStatus',
    'name' => 'Check Document Status',
    'description' => 'Retrieve the current status of a document translation process. If the translation is still in progress, the estimated time remaining is also included in the response.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The document ID that was sent to the client when the document was uploaded to the API.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/x-www-form-urlencoded',
        1 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_download_document' =>
  array (
    'slug' => 'deepl_download_document',
    'class' => 'DeepLDownloadDocument',
    'method' => 'POST',
    'path' => '/v2/document/{document_id}/result',
    'operation_id' => 'downloadDocument',
    'name' => 'Download Translated Document',
    'description' => 'Once the status of the document translation process is done, the result can be downloaded. For privacy reasons the translated document is automatically removed from the server once it was downloaded and cannot be downloaded again.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The document ID that was sent to the client when the document was uploaded to the API.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/x-www-form-urlencoded',
        1 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_list_glossary_languages' =>
  array (
    'slug' => 'deepl_list_glossary_languages',
    'class' => 'DeepLListGlossaryLanguages',
    'method' => 'GET',
    'path' => '/v2/glossary-language-pairs',
    'operation_id' => 'listGlossaryLanguages',
    'name' => 'List Language Pairs Supported by Glossaries',
    'description' => 'Retrieve the list of language pairs supported by the glossary feature.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'deepl_create_multilingual_glossary' =>
  array (
    'slug' => 'deepl_create_multilingual_glossary',
    'class' => 'DeepLCreateMultilingualGlossary',
    'method' => 'POST',
    'path' => '/v3/glossaries',
    'operation_id' => 'createMultilingualGlossary',
    'name' => 'Create a Glossary',
    'description' => 'Create a Glossary',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_list_multilingual_glossaries' =>
  array (
    'slug' => 'deepl_list_multilingual_glossaries',
    'class' => 'DeepLListMultilingualGlossaries',
    'method' => 'GET',
    'path' => '/v3/glossaries',
    'operation_id' => 'listMultilingualGlossaries',
    'name' => 'List all Glossaries',
    'description' => 'List all glossaries and their meta-information, but not the glossary entries.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'deepl_get_multilingual_glossary' =>
  array (
    'slug' => 'deepl_get_multilingual_glossary',
    'class' => 'DeepLGetMultilingualGlossary',
    'method' => 'GET',
    'path' => '/v3/glossaries/{glossary_id}',
    'operation_id' => 'getMultilingualGlossary',
    'name' => 'Retrieve Glossary Details',
    'description' => 'Retrieve meta information for a single glossary, omitting the glossary entries.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_patch_multilingual_glossary' =>
  array (
    'slug' => 'deepl_patch_multilingual_glossary',
    'class' => 'DeepLPatchMultilingualGlossary',
    'method' => 'PATCH',
    'path' => '/v3/glossaries/{glossary_id}',
    'operation_id' => 'patchMultilingualGlossary',
    'name' => 'Edit glossary details',
    'description' => 'Edit glossary details, such as name or a dictionary for a source and target language.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_delete_multilingual_glossary' =>
  array (
    'slug' => 'deepl_delete_multilingual_glossary',
    'class' => 'DeepLDeleteMultilingualGlossary',
    'method' => 'DELETE',
    'path' => '/v3/glossaries/{glossary_id}',
    'operation_id' => 'deleteMultilingualGlossary',
    'name' => 'Delete a Glossary',
    'description' => 'Deletes the specified glossary.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_get_multilingual_glossary_entries' =>
  array (
    'slug' => 'deepl_get_multilingual_glossary_entries',
    'class' => 'DeepLGetMultilingualGlossaryEntries',
    'method' => 'GET',
    'path' => '/v3/glossaries/{glossary_id}/entries',
    'operation_id' => 'getMultilingualGlossaryEntries',
    'name' => 'Retrieve Glossary Entries',
    'description' => 'List the entries of a single glossary in tsv format.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
      1 =>
      array (
        'name' => 'source_lang',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'target_lang',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_delete_dictionary' =>
  array (
    'slug' => 'deepl_delete_dictionary',
    'class' => 'DeepLDeleteDictionary',
    'method' => 'DELETE',
    'path' => '/v3/glossaries/{glossary_id}/dictionaries',
    'operation_id' => 'deleteDictionary',
    'name' => 'Deletes the dictionary associated with the given language pair with the given glossary ID.',
    'description' => 'Deletes the dictionary associated with the given language pair with the given glossary ID.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
      1 =>
      array (
        'name' => 'source_lang',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'target_lang',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_replace_dictionary' =>
  array (
    'slug' => 'deepl_replace_dictionary',
    'class' => 'DeepLReplaceDictionary',
    'method' => 'PUT',
    'path' => '/v3/glossaries/{glossary_id}/dictionaries',
    'operation_id' => 'replaceDictionary',
    'name' => 'Replaces or creates a dictionary in the glossary with the specified entries.',
    'description' => 'Replaces or creates a dictionary in the glossary with the specified entries.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'The dictionary to insert into or overwrite in the multilingual glossary.',
    ),
  ),
  'deepl_create_glossary' =>
  array (
    'slug' => 'deepl_create_glossary',
    'class' => 'DeepLCreateGlossary',
    'method' => 'POST',
    'path' => '/v2/glossaries',
    'operation_id' => 'createGlossary',
    'name' => 'Create a Glossary',
    'description' => 'Create a Glossary',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_list_glossaries' =>
  array (
    'slug' => 'deepl_list_glossaries',
    'class' => 'DeepLListGlossaries',
    'method' => 'GET',
    'path' => '/v2/glossaries',
    'operation_id' => 'listGlossaries',
    'name' => 'List all Glossaries',
    'description' => 'List all glossaries and their meta-information, but not the glossary entries.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'deepl_get_glossary' =>
  array (
    'slug' => 'deepl_get_glossary',
    'class' => 'DeepLGetGlossary',
    'method' => 'GET',
    'path' => '/v2/glossaries/{glossary_id}',
    'operation_id' => 'getGlossary',
    'name' => 'Retrieve Glossary Details',
    'description' => 'Retrieve meta information for a single glossary, omitting the glossary entries.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_delete_glossary' =>
  array (
    'slug' => 'deepl_delete_glossary',
    'class' => 'DeepLDeleteGlossary',
    'method' => 'DELETE',
    'path' => '/v2/glossaries/{glossary_id}',
    'operation_id' => 'deleteGlossary',
    'name' => 'Delete a Glossary',
    'description' => 'Deletes the specified glossary.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_get_glossary_entries' =>
  array (
    'slug' => 'deepl_get_glossary_entries',
    'class' => 'DeepLGetGlossaryEntries',
    'method' => 'GET',
    'path' => '/v2/glossaries/{glossary_id}/entries',
    'operation_id' => 'getGlossaryEntries',
    'name' => 'Retrieve Glossary Entries',
    'description' => 'List the entries of a single glossary in the format specified by the Accept header.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'glossary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'A unique ID assigned to the glossary.',
      ),
      1 =>
      array (
        'name' => 'Accept',
        'in' => 'header',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The requested format of the returned glossary entries. Currently, supports only text/tab-separated-values.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_rephrase_text' =>
  array (
    'slug' => 'deepl_rephrase_text',
    'class' => 'DeepLRephraseText',
    'method' => 'POST',
    'path' => '/v2/write/rephrase',
    'operation_id' => 'rephraseText',
    'name' => 'Request text improvement',
    'description' => 'Request text improvement',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
        1 => 'application/x-www-form-urlencoded',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_get_usage' =>
  array (
    'slug' => 'deepl_get_usage',
    'class' => 'DeepLGetUsage',
    'method' => 'GET',
    'path' => '/v2/usage',
    'operation_id' => 'getUsage',
    'name' => 'Check Usage and Limits',
    'description' => 'Retrieve usage information within the current billing period together with the corresponding account limits. Usage is returned for translated characters, translated documents, and translated documents team totals for team accounts only. Character usage includes both text and document translations, and is measured by the source text length in Unicode code points. Document usage only includes document translations, and is measured in individual documents. Depending on the user account type, some usage types will be omitted. Character usage is only included for developer accounts. Document usage is only included for non-developer accounts, and team-combined document usage is only included for non-developer team accounts.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'deepl_list_languages' =>
  array (
    'slug' => 'deepl_list_languages',
    'class' => 'DeepLListLanguages',
    'method' => 'GET',
    'path' => '/v2/languages',
    'operation_id' => 'getLanguages',
    'name' => 'Retrieve Supported Languages',
    'description' => 'Retrieve the list of languages that are currently supported for translation, either as source or target language, respectively.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Sets whether source or target languages should be listed. Possible options are: source default: For languages that can be used in the sourcelang parameter of translatehttps://www.deepl.com/docs-api/translate-text/translate-text requests. target: For languages that can be used in the targetlang parameter of translatehttps://www.deepl.com/docs-api/translate-text/translate-text requests.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_admin_create_developer_key' =>
  array (
    'slug' => 'deepl_admin_create_developer_key',
    'class' => 'DeepLAdminCreateDeveloperKey',
    'method' => 'POST',
    'path' => '/v2/admin/developer-keys',
    'operation_id' => 'adminCreateDeveloperKey',
    'name' => 'Create a developer key as an admin',
    'description' => 'Create a developer key as an admin',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_admin_get_developer_keys' =>
  array (
    'slug' => 'deepl_admin_get_developer_keys',
    'class' => 'DeepLAdminGetDeveloperKeys',
    'method' => 'GET',
    'path' => '/v2/admin/developer-keys',
    'operation_id' => 'adminGetDeveloperKeys',
    'name' => 'Get all developer keys as an admin',
    'description' => 'Get all developer keys as an admin',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'deepl_admin_deactivate_developer_key' =>
  array (
    'slug' => 'deepl_admin_deactivate_developer_key',
    'class' => 'DeepLAdminDeactivateDeveloperKey',
    'method' => 'PUT',
    'path' => '/v2/admin/developer-keys/deactivate',
    'operation_id' => 'adminDeactivateDeveloperKey',
    'name' => 'Deactivate a developer key as an admin',
    'description' => 'Deactivate a developer key as an admin',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_admin_rename_developer_key' =>
  array (
    'slug' => 'deepl_admin_rename_developer_key',
    'class' => 'DeepLAdminRenameDeveloperKey',
    'method' => 'PUT',
    'path' => '/v2/admin/developer-keys/label',
    'operation_id' => 'adminRenameDeveloperKey',
    'name' => 'Rename a developer key as an admin',
    'description' => 'Rename a developer key as an admin',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_admin_set_developer_key_usage_limits' =>
  array (
    'slug' => 'deepl_admin_set_developer_key_usage_limits',
    'class' => 'DeepLAdminSetDeveloperKeyUsageLimits',
    'method' => 'PUT',
    'path' => '/v2/admin/developer-keys/limits',
    'operation_id' => 'adminSetDeveloperKeyUsageLimits',
    'name' => 'Set developer key usage limits as an admin',
    'description' => 'Set developer key usage limits as an admin',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_admin_get_analytics' =>
  array (
    'slug' => 'deepl_admin_get_analytics',
    'class' => 'DeepLAdminGetAnalytics',
    'method' => 'GET',
    'path' => '/v2/admin/analytics',
    'operation_id' => 'adminGetAnalytics',
    'name' => 'Get usage statistics as an admin',
    'description' => 'Retrieve usage statistics for the organization within a specified date range. Optionally group the results by API key or by API key and day.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Start date for the usage report ISO 8601 date format.',
      ),
      1 =>
      array (
        'name' => 'end_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'End date for the usage report ISO 8601 date format.',
      ),
      2 =>
      array (
        'name' => 'group_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional parameter to group usage statistics. Possible values: key - Group by API key keyandday - Group by API key and usage date',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_get_style_rule_lists' =>
  array (
    'slug' => 'deepl_get_style_rule_lists',
    'class' => 'DeepLGetStyleRuleLists',
    'method' => 'GET',
    'path' => '/v3/style_rules',
    'operation_id' => 'getStyleRuleLists',
    'name' => 'Retrieve style rule lists',
    'description' => 'Retrieve style rule lists',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The index of the first page to return. Use with pagesize to get the next page of rule lists',
      ),
      1 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The maximum number of style rule lists to return.',
      ),
      2 =>
      array (
        'name' => 'detailed',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Determines if the rule list\'s configuredrules and custominstructions should be included in the response body.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_create_style_rule_list' =>
  array (
    'slug' => 'deepl_create_style_rule_list',
    'class' => 'DeepLCreateStyleRuleList',
    'method' => 'POST',
    'path' => '/v3/style_rules',
    'operation_id' => 'createStyleRuleList',
    'name' => 'Create a style rule list',
    'description' => 'Create a style rule list',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_get_style_rule_list' =>
  array (
    'slug' => 'deepl_get_style_rule_list',
    'class' => 'DeepLGetStyleRuleList',
    'method' => 'GET',
    'path' => '/v3/style_rules/{style_id}',
    'operation_id' => 'getStyleRuleList',
    'name' => 'Retrieve a style rule list',
    'description' => 'Retrieve a style rule list',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_update_style_rule_list' =>
  array (
    'slug' => 'deepl_update_style_rule_list',
    'class' => 'DeepLUpdateStyleRuleList',
    'method' => 'PATCH',
    'path' => '/v3/style_rules/{style_id}',
    'operation_id' => 'updateStyleRuleList',
    'name' => 'Update a style rule list',
    'description' => 'Update a style rule list',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_delete_style_rule_list' =>
  array (
    'slug' => 'deepl_delete_style_rule_list',
    'class' => 'DeepLDeleteStyleRuleList',
    'method' => 'DELETE',
    'path' => '/v3/style_rules/{style_id}',
    'operation_id' => 'deleteStyleRuleList',
    'name' => 'Delete a style rule list',
    'description' => 'Delete a style rule list',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_update_style_rule_configured_rules' =>
  array (
    'slug' => 'deepl_update_style_rule_configured_rules',
    'class' => 'DeepLUpdateStyleRuleConfiguredRules',
    'method' => 'PUT',
    'path' => '/v3/style_rules/{style_id}/configured_rules',
    'operation_id' => 'updateStyleRuleConfiguredRules',
    'name' => 'Update configured rules for a style rule list',
    'description' => 'Update configured rules for a style rule list',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_create_custom_instruction' =>
  array (
    'slug' => 'deepl_create_custom_instruction',
    'class' => 'DeepLCreateCustomInstruction',
    'method' => 'POST',
    'path' => '/v3/style_rules/{style_id}/custom_instructions',
    'operation_id' => 'createCustomInstruction',
    'name' => 'Create a custom instruction',
    'description' => 'Create a custom instruction',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_get_custom_instruction' =>
  array (
    'slug' => 'deepl_get_custom_instruction',
    'class' => 'DeepLGetCustomInstruction',
    'method' => 'GET',
    'path' => '/v3/style_rules/{style_id}/custom_instructions/{instruction_id}',
    'operation_id' => 'getCustomInstruction',
    'name' => 'Retrieve a custom instruction',
    'description' => 'Retrieve a custom instruction',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
      1 =>
      array (
        'name' => 'instruction_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the custom instruction',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_update_custom_instruction' =>
  array (
    'slug' => 'deepl_update_custom_instruction',
    'class' => 'DeepLUpdateCustomInstruction',
    'method' => 'PUT',
    'path' => '/v3/style_rules/{style_id}/custom_instructions/{instruction_id}',
    'operation_id' => 'updateCustomInstruction',
    'name' => 'Update a custom instruction',
    'description' => 'Update a custom instruction',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
      1 =>
      array (
        'name' => 'instruction_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the custom instruction',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_delete_custom_instruction' =>
  array (
    'slug' => 'deepl_delete_custom_instruction',
    'class' => 'DeepLDeleteCustomInstruction',
    'method' => 'DELETE',
    'path' => '/v3/style_rules/{style_id}/custom_instructions/{instruction_id}',
    'operation_id' => 'deleteCustomInstruction',
    'name' => 'Delete a custom instruction',
    'description' => 'Delete a custom instruction',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'style_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the style rule list',
      ),
      1 =>
      array (
        'name' => 'instruction_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique ID of the custom instruction',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_list_translation_memories' =>
  array (
    'slug' => 'deepl_list_translation_memories',
    'class' => 'DeepLListTranslationMemories',
    'method' => 'GET',
    'path' => '/v3/translation_memories',
    'operation_id' => 'listTranslationMemories',
    'name' => 'List translation memories',
    'description' => 'Retrieve a list of translation memories associated with the authenticated account.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The index of the first page to return. Use with pagesize to get the next page of translation memories.',
      ),
      1 =>
      array (
        'name' => 'page_size',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The maximum number of translation memories to return.',
      ),
    ),
    'request_body' => NULL,
  ),
  'deepl_get_voice_streaming_url' =>
  array (
    'slug' => 'deepl_get_voice_streaming_url',
    'class' => 'DeepLGetVoiceStreamingUrl',
    'method' => 'POST',
    'path' => '/v3/voice/realtime',
    'operation_id' => 'getVoiceStreamingUrl',
    'name' => 'Get Streaming URL',
    'description' => 'Get Streaming URL',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'default_content_type' => 'application/json',
      'description' => 'Request body for the DeepL API operation.',
    ),
  ),
  'deepl_request_reconnection' =>
  array (
    'slug' => 'deepl_request_reconnection',
    'class' => 'DeepLRequestReconnection',
    'method' => 'GET',
    'path' => '/v3/voice/realtime',
    'operation_id' => 'requestReconnection',
    'name' => 'Request Reconnection',
    'description' => 'Request Reconnection',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'token',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The latest ephemeral token obtained for the stream.',
      ),
    ),
    'request_body' => NULL,
  ),
);
    }
}
