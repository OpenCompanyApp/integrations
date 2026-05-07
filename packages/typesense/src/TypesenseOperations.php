<?php

namespace OpenCompany\Integrations\Typesense;

/**
 * Official Typesense OpenAPI operation metadata.
 *
 * Generated from Typesense's published OpenAPI schema so tool discovery stays
 * aligned with the upstream REST API surface.
 */
class TypesenseOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'typesense_clear_cache' =>
  array (
    'slug' => 'typesense_clear_cache',
    'class' => 'TypesenseClearCache',
    'method' => 'POST',
    'path' => '/operations/cache/clear',
    'operation_id' => 'clearCache',
    'name' => 'Clear the cached responses of search requests in the LRU cache.',
    'description' => 'Clear the cached responses of search requests in the LRU cache. Clear the cached responses of search requests that are sent with `use_cache` parameter in the LRU cache.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_compact_db' =>
  array (
    'slug' => 'typesense_compact_db',
    'class' => 'TypesenseCompactDb',
    'method' => 'POST',
    'path' => '/operations/db/compact',
    'operation_id' => 'compactDb',
    'name' => 'Compacting the on-disk database',
    'description' => 'Compacting the on-disk database Typesense uses RocksDB to store your documents on the disk. If you do frequent writes or updates, you could benefit from running a compaction of the underlying RocksDB database. This could reduce the size of the database and decrease read latency. While the database will not block during this operation, we recommend running it during off-peak hours.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_create_analytics_event' =>
  array (
    'slug' => 'typesense_create_analytics_event',
    'class' => 'TypesenseCreateAnalyticsEvent',
    'method' => 'POST',
    'path' => '/analytics/events',
    'operation_id' => 'createAnalyticsEvent',
    'name' => 'Create an analytics event',
    'description' => 'Create an analytics event Submit a single analytics event. The event must correspond to an existing analytics rule by name.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The analytics event to be created',
    ),
  ),
  'typesense_create_analytics_rule' =>
  array (
    'slug' => 'typesense_create_analytics_rule',
    'class' => 'TypesenseCreateAnalyticsRule',
    'method' => 'POST',
    'path' => '/analytics/rules',
    'operation_id' => 'createAnalyticsRule',
    'name' => 'Create analytics rule(s)',
    'description' => 'Create analytics rule(s) Create one or more analytics rules. You can send a single rule object or an array of rule objects.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The analytics rule(s) to be created',
    ),
  ),
  'typesense_create_collection' =>
  array (
    'slug' => 'typesense_create_collection',
    'class' => 'TypesenseCreateCollection',
    'method' => 'POST',
    'path' => '/collections',
    'operation_id' => 'createCollection',
    'name' => 'Create a new collection',
    'description' => 'Create a new collection When a collection is created, we give it a name and describe the fields that will be indexed from the documents added to the collection.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The collection object to be created',
    ),
  ),
  'typesense_create_conversation_model' =>
  array (
    'slug' => 'typesense_create_conversation_model',
    'class' => 'TypesenseCreateConversationModel',
    'method' => 'POST',
    'path' => '/conversations/models',
    'operation_id' => 'createConversationModel',
    'name' => 'Create a conversation model',
    'description' => 'Create a conversation model Create a Conversation Model',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Typesense API operation.',
    ),
  ),
  'typesense_create_key' =>
  array (
    'slug' => 'typesense_create_key',
    'class' => 'TypesenseCreateKey',
    'method' => 'POST',
    'path' => '/keys',
    'operation_id' => 'createKey',
    'name' => 'Create an API Key',
    'description' => 'Create an API Key with fine-grain access control. You can restrict access on both a per-collection and per-action level. The generated key is returned only during creation. You want to store this key carefully in a secure place.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The object that describes API key scope',
    ),
  ),
  'typesense_create_n_l_search_model' =>
  array (
    'slug' => 'typesense_create_n_l_search_model',
    'class' => 'TypesenseCreateNLSearchModel',
    'method' => 'POST',
    'path' => '/nl_search_models',
    'operation_id' => 'createNLSearchModel',
    'name' => 'Create a NL search model',
    'description' => 'Create a NL search model Create a new NL search model.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The NL search model to be created',
    ),
  ),
  'typesense_debug' =>
  array (
    'slug' => 'typesense_debug',
    'class' => 'TypesenseDebug',
    'method' => 'GET',
    'path' => '/debug',
    'operation_id' => 'debug',
    'name' => 'Print debugging information',
    'description' => 'Print debugging information',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_alias' =>
  array (
    'slug' => 'typesense_delete_alias',
    'class' => 'TypesenseDeleteAlias',
    'method' => 'DELETE',
    'path' => '/aliases/{aliasName}',
    'operation_id' => 'deleteAlias',
    'name' => 'Delete an alias',
    'description' => 'Delete an alias',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'aliasName',
        'argument_name' => 'alias_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the alias to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_analytics_rule' =>
  array (
    'slug' => 'typesense_delete_analytics_rule',
    'class' => 'TypesenseDeleteAnalyticsRule',
    'method' => 'DELETE',
    'path' => '/analytics/rules/{ruleName}',
    'operation_id' => 'deleteAnalyticsRule',
    'name' => 'Delete an analytics rule',
    'description' => 'Delete an analytics rule Permanently deletes an analytics rule, given it\'s name',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ruleName',
        'argument_name' => 'rule_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the analytics rule to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_collection' =>
  array (
    'slug' => 'typesense_delete_collection',
    'class' => 'TypesenseDeleteCollection',
    'method' => 'DELETE',
    'path' => '/collections/{collectionName}',
    'operation_id' => 'deleteCollection',
    'name' => 'Delete a collection',
    'description' => 'Delete a collection Permanently drops a collection. This action cannot be undone. For large collections, this might have an impact on read latencies.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_conversation_model' =>
  array (
    'slug' => 'typesense_delete_conversation_model',
    'class' => 'TypesenseDeleteConversationModel',
    'method' => 'DELETE',
    'path' => '/conversations/models/{modelId}',
    'operation_id' => 'deleteConversationModel',
    'name' => 'Delete a conversation model',
    'description' => 'Delete a conversation model',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the conversation model to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_curation_set' =>
  array (
    'slug' => 'typesense_delete_curation_set',
    'class' => 'TypesenseDeleteCurationSet',
    'method' => 'DELETE',
    'path' => '/curation_sets/{curationSetName}',
    'operation_id' => 'deleteCurationSet',
    'name' => 'Delete a curation set',
    'description' => 'Delete a curation set Delete a specific curation set by its name',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_curation_set_item' =>
  array (
    'slug' => 'typesense_delete_curation_set_item',
    'class' => 'TypesenseDeleteCurationSetItem',
    'method' => 'DELETE',
    'path' => '/curation_sets/{curationSetName}/items/{itemId}',
    'operation_id' => 'deleteCurationSetItem',
    'name' => 'Delete a curation set item',
    'description' => 'Delete a curation set item Delete a specific curation item by its id',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the curation item to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_document' =>
  array (
    'slug' => 'typesense_delete_document',
    'class' => 'TypesenseDeleteDocument',
    'method' => 'DELETE',
    'path' => '/collections/{collectionName}/documents/{documentId}',
    'operation_id' => 'deleteDocument',
    'name' => 'Delete a document',
    'description' => 'Delete a document Delete an individual document from a collection by using its ID.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to search for the document under',
      ),
      1 =>
      array (
        'name' => 'documentId',
        'argument_name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Document ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_documents' =>
  array (
    'slug' => 'typesense_delete_documents',
    'class' => 'TypesenseDeleteDocuments',
    'method' => 'DELETE',
    'path' => '/collections/{collectionName}/documents',
    'operation_id' => 'deleteDocuments',
    'name' => 'Delete a bunch of documents',
    'description' => 'Delete a bunch of documents that match a specific filter condition. Use the `batch_size` parameter to control the number of documents that should deleted at a time. A larger value will speed up deletions, but will impact performance of other operations running on the server.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to delete documents from',
      ),
      1 =>
      array (
        'name' => 'deleteDocumentsParameters',
        'argument_name' => 'delete_documents_parameters',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_key' =>
  array (
    'slug' => 'typesense_delete_key',
    'class' => 'TypesenseDeleteKey',
    'method' => 'DELETE',
    'path' => '/keys/{keyId}',
    'operation_id' => 'deleteKey',
    'name' => 'Delete an API key given its ID.',
    'description' => 'Delete an API key given its ID.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyId',
        'argument_name' => 'key_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the key to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_n_l_search_model' =>
  array (
    'slug' => 'typesense_delete_n_l_search_model',
    'class' => 'TypesenseDeleteNLSearchModel',
    'method' => 'DELETE',
    'path' => '/nl_search_models/{modelId}',
    'operation_id' => 'deleteNLSearchModel',
    'name' => 'Delete a NL search model',
    'description' => 'Delete a NL search model Delete a specific NL search model by its ID.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the NL search model to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_preset' =>
  array (
    'slug' => 'typesense_delete_preset',
    'class' => 'TypesenseDeletePreset',
    'method' => 'DELETE',
    'path' => '/presets/{presetId}',
    'operation_id' => 'deletePreset',
    'name' => 'Delete a preset.',
    'description' => 'Delete a preset. Permanently deletes a preset, given it\'s name.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'presetId',
        'argument_name' => 'preset_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the preset to delete.',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_stopwords_set' =>
  array (
    'slug' => 'typesense_delete_stopwords_set',
    'class' => 'TypesenseDeleteStopwordsSet',
    'method' => 'DELETE',
    'path' => '/stopwords/{setId}',
    'operation_id' => 'deleteStopwordsSet',
    'name' => 'Delete a stopwords set.',
    'description' => 'Delete a stopwords set. Permanently deletes a stopwords set, given it\'s name.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'setId',
        'argument_name' => 'set_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the stopwords set to delete.',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_synonym_set' =>
  array (
    'slug' => 'typesense_delete_synonym_set',
    'class' => 'TypesenseDeleteSynonymSet',
    'method' => 'DELETE',
    'path' => '/synonym_sets/{synonymSetName}',
    'operation_id' => 'deleteSynonymSet',
    'name' => 'Delete a synonym set',
    'description' => 'Delete a synonym set Delete a specific synonym set by its name',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_delete_synonym_set_item' =>
  array (
    'slug' => 'typesense_delete_synonym_set_item',
    'class' => 'TypesenseDeleteSynonymSetItem',
    'method' => 'DELETE',
    'path' => '/synonym_sets/{synonymSetName}/items/{itemId}',
    'operation_id' => 'deleteSynonymSetItem',
    'name' => 'Delete a synonym set item',
    'description' => 'Delete a synonym set item Delete a specific synonym item by its id',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the synonym item to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_export_documents' =>
  array (
    'slug' => 'typesense_export_documents',
    'class' => 'TypesenseExportDocuments',
    'method' => 'GET',
    'path' => '/collections/{collectionName}/documents/export',
    'operation_id' => 'exportDocuments',
    'name' => 'Export all documents in a collection',
    'description' => 'Export all documents in a collection in JSON lines format.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection',
      ),
      1 =>
      array (
        'name' => 'exportDocumentsParameters',
        'argument_name' => 'export_documents_parameters',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_flush_analytics' =>
  array (
    'slug' => 'typesense_flush_analytics',
    'class' => 'TypesenseFlushAnalytics',
    'method' => 'POST',
    'path' => '/analytics/flush',
    'operation_id' => 'flushAnalytics',
    'name' => 'Flush in-memory analytics to disk',
    'description' => 'Flush in-memory analytics to disk Triggers a flush of analytics data to persistent storage.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_alias' =>
  array (
    'slug' => 'typesense_get_alias',
    'class' => 'TypesenseGetAlias',
    'method' => 'GET',
    'path' => '/aliases/{aliasName}',
    'operation_id' => 'getAlias',
    'name' => 'Retrieve an alias',
    'description' => 'Retrieve an alias Find out which collection an alias points to by fetching it',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'aliasName',
        'argument_name' => 'alias_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the alias to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_get_aliases' =>
  array (
    'slug' => 'typesense_get_aliases',
    'class' => 'TypesenseGetAliases',
    'method' => 'GET',
    'path' => '/aliases',
    'operation_id' => 'getAliases',
    'name' => 'List all aliases',
    'description' => 'List all aliases and the corresponding collections that they map to.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_analytics_events' =>
  array (
    'slug' => 'typesense_get_analytics_events',
    'class' => 'TypesenseGetAnalyticsEvents',
    'method' => 'GET',
    'path' => '/analytics/events',
    'operation_id' => 'getAnalyticsEvents',
    'name' => 'Retrieve analytics events',
    'description' => 'Retrieve analytics events Retrieve the most recent events for a user and rule.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'name',
        'argument_name' => 'name',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Analytics rule name',
      ),
      2 =>
      array (
        'name' => 'n',
        'argument_name' => 'n',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'Number of events to return (max 1000)',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_get_analytics_status' =>
  array (
    'slug' => 'typesense_get_analytics_status',
    'class' => 'TypesenseGetAnalyticsStatus',
    'method' => 'GET',
    'path' => '/analytics/status',
    'operation_id' => 'getAnalyticsStatus',
    'name' => 'Get analytics subsystem status',
    'description' => 'Get analytics subsystem status Returns sizes of internal analytics buffers and queues.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_collection' =>
  array (
    'slug' => 'typesense_get_collection',
    'class' => 'TypesenseGetCollection',
    'method' => 'GET',
    'path' => '/collections/{collectionName}',
    'operation_id' => 'getCollection',
    'name' => 'Retrieve a single collection',
    'description' => 'Retrieve a single collection Retrieve the details of a collection, given its name.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_get_document' =>
  array (
    'slug' => 'typesense_get_document',
    'class' => 'TypesenseGetDocument',
    'method' => 'GET',
    'path' => '/collections/{collectionName}/documents/{documentId}',
    'operation_id' => 'getDocument',
    'name' => 'Retrieve a document',
    'description' => 'Retrieve a document Fetch an individual document from a collection by using its ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to search for the document under',
      ),
      1 =>
      array (
        'name' => 'documentId',
        'argument_name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Document ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_get_health' =>
  array (
    'slug' => 'typesense_get_health',
    'class' => 'TypesenseGetHealth',
    'method' => 'GET',
    'path' => '/health',
    'operation_id' => 'health',
    'name' => 'Checks if Typesense server is ready to accept requests.',
    'description' => 'Checks if Typesense server is ready to accept requests.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_key' =>
  array (
    'slug' => 'typesense_get_key',
    'class' => 'TypesenseGetKey',
    'method' => 'GET',
    'path' => '/keys/{keyId}',
    'operation_id' => 'getKey',
    'name' => 'Retrieve (metadata about) a key',
    'description' => 'Retrieve (metadata about) a key. Only the key prefix is returned when you retrieve a key. Due to security reasons, only the create endpoint returns the full API key.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyId',
        'argument_name' => 'key_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the key to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_get_keys' =>
  array (
    'slug' => 'typesense_get_keys',
    'class' => 'TypesenseGetKeys',
    'method' => 'GET',
    'path' => '/keys',
    'operation_id' => 'getKeys',
    'name' => 'Retrieve (metadata about) all keys.',
    'description' => 'Retrieve (metadata about) all keys.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_schema_changes' =>
  array (
    'slug' => 'typesense_get_schema_changes',
    'class' => 'TypesenseGetSchemaChanges',
    'method' => 'GET',
    'path' => '/operations/schema_changes',
    'operation_id' => 'getSchemaChanges',
    'name' => 'Get the status of in-progress schema change operations',
    'description' => 'Get the status of in-progress schema change operations Returns the status of any ongoing schema change operations. If no schema changes are in progress, returns an empty response.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_get_stemming_dictionary' =>
  array (
    'slug' => 'typesense_get_stemming_dictionary',
    'class' => 'TypesenseGetStemmingDictionary',
    'method' => 'GET',
    'path' => '/stemming/dictionaries/{dictionaryId}',
    'operation_id' => 'getStemmingDictionary',
    'name' => 'Retrieve a stemming dictionary',
    'description' => 'Retrieve a stemming dictionary Fetch details of a specific stemming dictionary.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'dictionaryId',
        'argument_name' => 'dictionary_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the dictionary to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_import_documents' =>
  array (
    'slug' => 'typesense_import_documents',
    'class' => 'TypesenseImportDocuments',
    'method' => 'POST',
    'path' => '/collections/{collectionName}/documents/import',
    'operation_id' => 'importDocuments',
    'name' => 'Import documents into a collection',
    'description' => 'Import documents into a collection The documents to be imported must be formatted in a newline delimited JSON structure. You can feed the output file from a Typesense export operation directly as import.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection',
      ),
      1 =>
      array (
        'name' => 'importDocumentsParameters',
        'argument_name' => 'import_documents_parameters',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'description' => 'The json array of documents or the JSONL file to import',
    ),
  ),
  'typesense_import_stemming_dictionary' =>
  array (
    'slug' => 'typesense_import_stemming_dictionary',
    'class' => 'TypesenseImportStemmingDictionary',
    'method' => 'POST',
    'path' => '/stemming/dictionaries/import',
    'operation_id' => 'importStemmingDictionary',
    'name' => 'Import a stemming dictionary',
    'description' => 'Import a stemming dictionary Upload a JSONL file containing word mappings to create or update a stemming dictionary.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID to assign to the dictionary',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'description' => 'The JSONL file containing word mappings',
    ),
  ),
  'typesense_index_document' =>
  array (
    'slug' => 'typesense_index_document',
    'class' => 'TypesenseIndexDocument',
    'method' => 'POST',
    'path' => '/collections/{collectionName}/documents',
    'operation_id' => 'indexDocument',
    'name' => 'Index a document',
    'description' => 'Index a document A document to be indexed in a given collection must conform to the schema of the collection.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to add the document to',
      ),
      1 =>
      array (
        'name' => 'action',
        'argument_name' => 'action',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Additional action to perform',
      ),
      2 =>
      array (
        'name' => 'dirty_values',
        'argument_name' => 'dirty_values',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => 'Dealing with Dirty Data',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The document object to be indexed',
    ),
  ),
  'typesense_list_collections' =>
  array (
    'slug' => 'typesense_list_collections',
    'class' => 'TypesenseListCollections',
    'method' => 'GET',
    'path' => '/collections',
    'operation_id' => 'getCollections',
    'name' => 'List all collections',
    'description' => 'List all collections Returns a summary of all your collections. The collections are returned sorted by creation date, with the most recent collections appearing first.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'getCollectionsParameters',
        'argument_name' => 'get_collections_parameters',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_list_stemming_dictionaries' =>
  array (
    'slug' => 'typesense_list_stemming_dictionaries',
    'class' => 'TypesenseListStemmingDictionaries',
    'method' => 'GET',
    'path' => '/stemming/dictionaries',
    'operation_id' => 'listStemmingDictionaries',
    'name' => 'List all stemming dictionaries',
    'description' => 'List all stemming dictionaries Retrieve a list of all available stemming dictionaries.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_multi_search' =>
  array (
    'slug' => 'typesense_multi_search',
    'class' => 'TypesenseMultiSearch',
    'method' => 'POST',
    'path' => '/multi_search',
    'operation_id' => 'multiSearch',
    'name' => 'send multiple search requests in a single HTTP request',
    'description' => 'send multiple search requests in a single HTTP request This is especially useful to avoid round-trip network latencies incurred otherwise if each of these requests are sent in separate HTTP requests. You can also use this feature to do a federated search across multiple collections in a single HTTP request.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'multiSearchParameters',
        'argument_name' => 'multi_search_parameters',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Typesense API operation.',
    ),
  ),
  'typesense_retrieve_a_p_i_stats' =>
  array (
    'slug' => 'typesense_retrieve_a_p_i_stats',
    'class' => 'TypesenseRetrieveAPIStats',
    'method' => 'GET',
    'path' => '/stats.json',
    'operation_id' => 'retrieveAPIStats',
    'name' => 'Get stats about API endpoints.',
    'description' => 'Get stats about API endpoints. Retrieve the stats about API endpoints.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_all_conversation_models' =>
  array (
    'slug' => 'typesense_retrieve_all_conversation_models',
    'class' => 'TypesenseRetrieveAllConversationModels',
    'method' => 'GET',
    'path' => '/conversations/models',
    'operation_id' => 'retrieveAllConversationModels',
    'name' => 'List all conversation models',
    'description' => 'List all conversation models Retrieve all conversation models',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_all_n_l_search_models' =>
  array (
    'slug' => 'typesense_retrieve_all_n_l_search_models',
    'class' => 'TypesenseRetrieveAllNLSearchModels',
    'method' => 'GET',
    'path' => '/nl_search_models',
    'operation_id' => 'retrieveAllNLSearchModels',
    'name' => 'List all NL search models',
    'description' => 'List all NL search models Retrieve all NL search models.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_all_presets' =>
  array (
    'slug' => 'typesense_retrieve_all_presets',
    'class' => 'TypesenseRetrieveAllPresets',
    'method' => 'GET',
    'path' => '/presets',
    'operation_id' => 'retrieveAllPresets',
    'name' => 'Retrieves all presets.',
    'description' => 'Retrieves all presets. Retrieve the details of all presets',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_analytics_rule' =>
  array (
    'slug' => 'typesense_retrieve_analytics_rule',
    'class' => 'TypesenseRetrieveAnalyticsRule',
    'method' => 'GET',
    'path' => '/analytics/rules/{ruleName}',
    'operation_id' => 'retrieveAnalyticsRule',
    'name' => 'Retrieves an analytics rule',
    'description' => 'Retrieves an analytics rule Retrieve the details of an analytics rule, given it\'s name',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ruleName',
        'argument_name' => 'rule_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the analytics rule to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_analytics_rules' =>
  array (
    'slug' => 'typesense_retrieve_analytics_rules',
    'class' => 'TypesenseRetrieveAnalyticsRules',
    'method' => 'GET',
    'path' => '/analytics/rules',
    'operation_id' => 'retrieveAnalyticsRules',
    'name' => 'Retrieve analytics rules',
    'description' => 'Retrieve analytics rules Retrieve all analytics rules. Use the optional rule_tag filter to narrow down results.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'rule_tag',
        'argument_name' => 'rule_tag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Filter rules by rule_tag',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_conversation_model' =>
  array (
    'slug' => 'typesense_retrieve_conversation_model',
    'class' => 'TypesenseRetrieveConversationModel',
    'method' => 'GET',
    'path' => '/conversations/models/{modelId}',
    'operation_id' => 'retrieveConversationModel',
    'name' => 'Retrieve a conversation model',
    'description' => 'Retrieve a conversation model',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the conversation model to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_curation_set' =>
  array (
    'slug' => 'typesense_retrieve_curation_set',
    'class' => 'TypesenseRetrieveCurationSet',
    'method' => 'GET',
    'path' => '/curation_sets/{curationSetName}',
    'operation_id' => 'retrieveCurationSet',
    'name' => 'Retrieve a curation set',
    'description' => 'Retrieve a curation set Retrieve a specific curation set by its name',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_curation_set_item' =>
  array (
    'slug' => 'typesense_retrieve_curation_set_item',
    'class' => 'TypesenseRetrieveCurationSetItem',
    'method' => 'GET',
    'path' => '/curation_sets/{curationSetName}/items/{itemId}',
    'operation_id' => 'retrieveCurationSetItem',
    'name' => 'Retrieve a curation set item',
    'description' => 'Retrieve a curation set item Retrieve a specific curation item by its id',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the curation item to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_curation_set_items' =>
  array (
    'slug' => 'typesense_retrieve_curation_set_items',
    'class' => 'TypesenseRetrieveCurationSetItems',
    'method' => 'GET',
    'path' => '/curation_sets/{curationSetName}/items',
    'operation_id' => 'retrieveCurationSetItems',
    'name' => 'List items in a curation set',
    'description' => 'List items in a curation set Retrieve all curation items in a set',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set to retrieve items for',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_curation_sets' =>
  array (
    'slug' => 'typesense_retrieve_curation_sets',
    'class' => 'TypesenseRetrieveCurationSets',
    'method' => 'GET',
    'path' => '/curation_sets',
    'operation_id' => 'retrieveCurationSets',
    'name' => 'List all curation sets',
    'description' => 'List all curation sets Retrieve all curation sets',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_metrics' =>
  array (
    'slug' => 'typesense_retrieve_metrics',
    'class' => 'TypesenseRetrieveMetrics',
    'method' => 'GET',
    'path' => '/metrics.json',
    'operation_id' => 'retrieveMetrics',
    'name' => 'Get current RAM, CPU, Disk & Network usage metrics.',
    'description' => 'Get current RAM, CPU, Disk & Network usage metrics. Retrieve the metrics.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_n_l_search_model' =>
  array (
    'slug' => 'typesense_retrieve_n_l_search_model',
    'class' => 'TypesenseRetrieveNLSearchModel',
    'method' => 'GET',
    'path' => '/nl_search_models/{modelId}',
    'operation_id' => 'retrieveNLSearchModel',
    'name' => 'Retrieve a NL search model',
    'description' => 'Retrieve a NL search model Retrieve a specific NL search model by its ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the NL search model to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_preset' =>
  array (
    'slug' => 'typesense_retrieve_preset',
    'class' => 'TypesenseRetrievePreset',
    'method' => 'GET',
    'path' => '/presets/{presetId}',
    'operation_id' => 'retrievePreset',
    'name' => 'Retrieves a preset.',
    'description' => 'Retrieves a preset. Retrieve the details of a preset, given it\'s name.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'presetId',
        'argument_name' => 'preset_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the preset to retrieve.',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_stopwords_set' =>
  array (
    'slug' => 'typesense_retrieve_stopwords_set',
    'class' => 'TypesenseRetrieveStopwordsSet',
    'method' => 'GET',
    'path' => '/stopwords/{setId}',
    'operation_id' => 'retrieveStopwordsSet',
    'name' => 'Retrieves a stopwords set.',
    'description' => 'Retrieves a stopwords set. Retrieve the details of a stopwords set, given it\'s name.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'setId',
        'argument_name' => 'set_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the stopwords set to retrieve.',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_stopwords_sets' =>
  array (
    'slug' => 'typesense_retrieve_stopwords_sets',
    'class' => 'TypesenseRetrieveStopwordsSets',
    'method' => 'GET',
    'path' => '/stopwords',
    'operation_id' => 'retrieveStopwordsSets',
    'name' => 'Retrieves all stopwords sets.',
    'description' => 'Retrieves all stopwords sets. Retrieve the details of all stopwords sets',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_synonym_set' =>
  array (
    'slug' => 'typesense_retrieve_synonym_set',
    'class' => 'TypesenseRetrieveSynonymSet',
    'method' => 'GET',
    'path' => '/synonym_sets/{synonymSetName}',
    'operation_id' => 'retrieveSynonymSet',
    'name' => 'Retrieve a synonym set',
    'description' => 'Retrieve a synonym set Retrieve a specific synonym set by its name',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_synonym_set_item' =>
  array (
    'slug' => 'typesense_retrieve_synonym_set_item',
    'class' => 'TypesenseRetrieveSynonymSetItem',
    'method' => 'GET',
    'path' => '/synonym_sets/{synonymSetName}/items/{itemId}',
    'operation_id' => 'retrieveSynonymSetItem',
    'name' => 'Retrieve a synonym set item',
    'description' => 'Retrieve a synonym set item Retrieve a specific synonym item by its id',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the synonym item to retrieve',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_synonym_set_items' =>
  array (
    'slug' => 'typesense_retrieve_synonym_set_items',
    'class' => 'TypesenseRetrieveSynonymSetItems',
    'method' => 'GET',
    'path' => '/synonym_sets/{synonymSetName}/items',
    'operation_id' => 'retrieveSynonymSetItems',
    'name' => 'List items in a synonym set',
    'description' => 'List items in a synonym set Retrieve all synonym items in a set',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set to retrieve items for',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_retrieve_synonym_sets' =>
  array (
    'slug' => 'typesense_retrieve_synonym_sets',
    'class' => 'TypesenseRetrieveSynonymSets',
    'method' => 'GET',
    'path' => '/synonym_sets',
    'operation_id' => 'retrieveSynonymSets',
    'name' => 'List all synonym sets',
    'description' => 'List all synonym sets Retrieve all synonym sets',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'typesense_search_documents' =>
  array (
    'slug' => 'typesense_search_documents',
    'class' => 'TypesenseSearchDocuments',
    'method' => 'GET',
    'path' => '/collections/{collectionName}/documents/search',
    'operation_id' => 'searchCollection',
    'name' => 'Search for documents in a collection',
    'description' => 'Search for documents in a collection that match the search criteria.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to search for the document under',
      ),
      1 =>
      array (
        'name' => 'searchParameters',
        'argument_name' => 'search_parameters',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_take_snapshot' =>
  array (
    'slug' => 'typesense_take_snapshot',
    'class' => 'TypesenseTakeSnapshot',
    'method' => 'POST',
    'path' => '/operations/snapshot',
    'operation_id' => 'takeSnapshot',
    'name' => 'Creates a point-in-time snapshot of a Typesense node\'s state and data in the specified directory.',
    'description' => 'Creates a point-in-time snapshot of a Typesense node\'s state and data in the specified directory. You can then backup the snapshot directory that gets created and later restore it as a data directory, as needed.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'snapshot_path',
        'argument_name' => 'snapshot_path',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The directory on the server where the snapshot should be saved.',
      ),
    ),
    'request_body' => NULL,
  ),
  'typesense_toggle_slow_request_log' =>
  array (
    'slug' => 'typesense_toggle_slow_request_log',
    'class' => 'TypesenseToggleSlowRequestLog',
    'method' => 'POST',
    'path' => '/config',
    'operation_id' => 'toggleSlowRequestLog',
    'name' => 'Toggle Slow Request Log',
    'description' => 'Toggle Slow Request Log Enable logging of requests that take over a defined threshold of time. Default is `-1` which disables slow request logging. Slow requests are logged to the primary log file, with the prefix SLOW REQUEST.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Typesense API operation.',
    ),
  ),
  'typesense_update_collection' =>
  array (
    'slug' => 'typesense_update_collection',
    'class' => 'TypesenseUpdateCollection',
    'method' => 'PATCH',
    'path' => '/collections/{collectionName}',
    'operation_id' => 'updateCollection',
    'name' => 'Update a collection',
    'description' => 'Update a collection\'s schema to modify the fields and their types.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to update',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The document object with fields to be updated',
    ),
  ),
  'typesense_update_conversation_model' =>
  array (
    'slug' => 'typesense_update_conversation_model',
    'class' => 'TypesenseUpdateConversationModel',
    'method' => 'PUT',
    'path' => '/conversations/models/{modelId}',
    'operation_id' => 'updateConversationModel',
    'name' => 'Update a conversation model',
    'description' => 'Update a conversation model',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the conversation model to update',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Typesense API operation.',
    ),
  ),
  'typesense_update_document' =>
  array (
    'slug' => 'typesense_update_document',
    'class' => 'TypesenseUpdateDocument',
    'method' => 'PATCH',
    'path' => '/collections/{collectionName}/documents/{documentId}',
    'operation_id' => 'updateDocument',
    'name' => 'Update a document',
    'description' => 'Update a document Update an individual document from a collection by using its ID. The update can be partial.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to search for the document under',
      ),
      1 =>
      array (
        'name' => 'documentId',
        'argument_name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The Document ID',
      ),
      2 =>
      array (
        'name' => 'dirty_values',
        'argument_name' => 'dirty_values',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => 'Dealing with Dirty Data',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The document object with fields to be updated',
    ),
  ),
  'typesense_update_documents' =>
  array (
    'slug' => 'typesense_update_documents',
    'class' => 'TypesenseUpdateDocuments',
    'method' => 'PATCH',
    'path' => '/collections/{collectionName}/documents',
    'operation_id' => 'updateDocuments',
    'name' => 'Update documents with conditional query',
    'description' => 'Update documents with conditional query The filter_by query parameter is used to filter to specify a condition against which the documents are matched. The request body contains the fields that should be updated for any documents that match the filter condition. This endpoint is only available if the Typesense server is version `0.25.0.rc12` or later.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'collectionName',
        'argument_name' => 'collection_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the collection to update documents in',
      ),
      1 =>
      array (
        'name' => 'updateDocumentsParameters',
        'argument_name' => 'update_documents_parameters',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'object',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The document fields to be updated',
    ),
  ),
  'typesense_update_n_l_search_model' =>
  array (
    'slug' => 'typesense_update_n_l_search_model',
    'class' => 'TypesenseUpdateNLSearchModel',
    'method' => 'PUT',
    'path' => '/nl_search_models/{modelId}',
    'operation_id' => 'updateNLSearchModel',
    'name' => 'Update a NL search model',
    'description' => 'Update a NL search model Update an existing NL search model.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'modelId',
        'argument_name' => 'model_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the NL search model to update',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The NL search model fields to update',
    ),
  ),
  'typesense_upsert_alias' =>
  array (
    'slug' => 'typesense_upsert_alias',
    'class' => 'TypesenseUpsertAlias',
    'method' => 'PUT',
    'path' => '/aliases/{aliasName}',
    'operation_id' => 'upsertAlias',
    'name' => 'Create or update a collection alias',
    'description' => 'Create or update a collection alias. An alias is a virtual collection name that points to a real collection. If you\'re familiar with symbolic links on Linux, it\'s very similar to that. Aliases are useful when you want to reindex your data in the background on a new collection and switch your application to it without any changes to your code.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'aliasName',
        'argument_name' => 'alias_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the alias to create/update',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Collection alias to be created/updated',
    ),
  ),
  'typesense_upsert_analytics_rule' =>
  array (
    'slug' => 'typesense_upsert_analytics_rule',
    'class' => 'TypesenseUpsertAnalyticsRule',
    'method' => 'PUT',
    'path' => '/analytics/rules/{ruleName}',
    'operation_id' => 'upsertAnalyticsRule',
    'name' => 'Upserts an analytics rule',
    'description' => 'Upserts an analytics rule with the given name.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ruleName',
        'argument_name' => 'rule_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the analytics rule to upsert',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The Analytics rule to be upserted',
    ),
  ),
  'typesense_upsert_curation_set' =>
  array (
    'slug' => 'typesense_upsert_curation_set',
    'class' => 'TypesenseUpsertCurationSet',
    'method' => 'PUT',
    'path' => '/curation_sets/{curationSetName}',
    'operation_id' => 'upsertCurationSet',
    'name' => 'Create or update a curation set',
    'description' => 'Create or update a curation set with the given name',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set to create/update',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The curation set to be created/updated',
    ),
  ),
  'typesense_upsert_curation_set_item' =>
  array (
    'slug' => 'typesense_upsert_curation_set_item',
    'class' => 'TypesenseUpsertCurationSetItem',
    'method' => 'PUT',
    'path' => '/curation_sets/{curationSetName}/items/{itemId}',
    'operation_id' => 'upsertCurationSetItem',
    'name' => 'Create or update a curation set item',
    'description' => 'Create or update a curation set item with the given id',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'curationSetName',
        'argument_name' => 'curation_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the curation set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the curation item to upsert',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The curation item to be created/updated',
    ),
  ),
  'typesense_upsert_preset' =>
  array (
    'slug' => 'typesense_upsert_preset',
    'class' => 'TypesenseUpsertPreset',
    'method' => 'PUT',
    'path' => '/presets/{presetId}',
    'operation_id' => 'upsertPreset',
    'name' => 'Upserts a preset.',
    'description' => 'Upserts a preset. Create or update an existing preset.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'presetId',
        'argument_name' => 'preset_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the preset set to upsert.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The stopwords set to upsert.',
    ),
  ),
  'typesense_upsert_stopwords_set' =>
  array (
    'slug' => 'typesense_upsert_stopwords_set',
    'class' => 'TypesenseUpsertStopwordsSet',
    'method' => 'PUT',
    'path' => '/stopwords/{setId}',
    'operation_id' => 'upsertStopwordsSet',
    'name' => 'Upserts a stopwords set.',
    'description' => 'Upserts a stopwords set. When an analytics rule is created, we give it a name and describe the type, the source collections and the destination collection.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'setId',
        'argument_name' => 'set_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the stopwords set to upsert.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The stopwords set to upsert.',
    ),
  ),
  'typesense_upsert_synonym_set' =>
  array (
    'slug' => 'typesense_upsert_synonym_set',
    'class' => 'TypesenseUpsertSynonymSet',
    'method' => 'PUT',
    'path' => '/synonym_sets/{synonymSetName}',
    'operation_id' => 'upsertSynonymSet',
    'name' => 'Create or update a synonym set',
    'description' => 'Create or update a synonym set with the given name',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set to create/update',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The synonym set to be created/updated',
    ),
  ),
  'typesense_upsert_synonym_set_item' =>
  array (
    'slug' => 'typesense_upsert_synonym_set_item',
    'class' => 'TypesenseUpsertSynonymSetItem',
    'method' => 'PUT',
    'path' => '/synonym_sets/{synonymSetName}/items/{itemId}',
    'operation_id' => 'upsertSynonymSetItem',
    'name' => 'Create or update a synonym set item',
    'description' => 'Create or update a synonym set item with the given id',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'synonymSetName',
        'argument_name' => 'synonym_set_name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The name of the synonym set',
      ),
      1 =>
      array (
        'name' => 'itemId',
        'argument_name' => 'item_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The id of the synonym item to upsert',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The synonym item to be created/updated',
    ),
  ),
  'typesense_vote' =>
  array (
    'slug' => 'typesense_vote',
    'class' => 'TypesenseVote',
    'method' => 'POST',
    'path' => '/operations/vote',
    'operation_id' => 'vote',
    'name' => 'Triggers a follower node to initiate the raft voting process, which triggers leader re-election.',
    'description' => 'Triggers a follower node to initiate the raft voting process, which triggers leader re-election. The follower node that you run this operation against will become the new leader, once this command succeeds.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
);
    }
}
