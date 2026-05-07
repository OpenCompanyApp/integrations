<?php

namespace OpenCompany\Integrations\Meilisearch;

/**
 * Official Meilisearch OpenAPI operation metadata.
 *
 * Generated from the v1.43.0 meilisearch-openapi.json release asset.
 */
final class MeilisearchOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'meilisearch_add_documents' =>
  array (
    'slug' => 'meilisearch_add_documents',
    'class' => 'MeilisearchAddDocuments',
    'type' => 'write',
    'name' => 'Add or replace documents',
    'description' => 'Add a list of documents or replace them if they already exist. If you send an already existing document (same id) the whole existing document will be overwritten by the new document. Fields previously in the document not present in the new document are removed. If the provided index does not exist, it will be created. For a partial update of the document see [add or update documents route](/reference/api/documents/add-or-update-documents). > Use the reserved `_geo` object to add geo coordinates to a document. > `_geo` is an object made of `lat` and `lng` field.',
    'operation_id' => 'replace_documents',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/documents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'primaryKey',
        'in' => 'query',
        'required' => false,
        'description' => 'The [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) field for uniquely identifying each document. This parameter is optional and can only be set the first time documents are added to an index. Subsequent attempts to specify it will be ignored if the primary key has already been set.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'csvDelimiter',
        'in' => 'query',
        'required' => false,
        'description' => 'Customize the csv delimiter when importing CSV documents.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'customMetadata',
        'in' => 'query',
        'required' => false,
        'description' => 'A string that can be used to identify and filter tasks. This metadata is stored with the task and returned in task responses. Useful for tracking tasks from external systems or associating tasks with specific operations in your application.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'skipCreation',
        'in' => 'query',
        'required' => false,
        'description' => 'When set to `true`, only updates existing documents and skips creating new ones. Documents that don\'t already exist in the index will be ignored. This is useful for partial updates where you only want to modify existing records without adding new ones.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_cancel_logs' =>
  array (
    'slug' => 'meilisearch_cancel_logs',
    'class' => 'MeilisearchCancelLogs',
    'type' => 'write',
    'name' => 'Stop retrieving logs',
    'description' => 'Call this route to make the engine stop sending logs to the client that opened the `POST /logs/stream` connection.',
    'operation_id' => 'cancel_logs',
    'method' => 'DELETE',
    'path' => '/logs/stream',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_cancel_tasks' =>
  array (
    'slug' => 'meilisearch_cancel_tasks',
    'class' => 'MeilisearchCancelTasks',
    'type' => 'write',
    'name' => 'Cancel tasks',
    'description' => 'Cancel enqueued and/or processing [tasks](https://www.meilisearch.com/docs/learn/async/asynchronous_operations). You must provide at least one filter (e.g. `uids`, `indexUids`, `statuses`) to specify which tasks to cancel.',
    'operation_id' => 'cancel_tasks',
    'method' => 'POST',
    'path' => '/tasks/cancel',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to select tasks by their uid. When the `uids` query parameter is set to `*`, all task uids included. It\'s possible to specify several uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'batchUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Lets you filter tasks by their `batchUid`.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'canceledBy',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks using the uid of the task that canceled them. It\'s possible to specify several task uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'types',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related type. By default, when `types` query parameter is not set, all task types are returned. It\'s possible to specify several types by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'statuses',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their status. By default, when `statuses` query parameter is not set, all task statuses are returned. It\'s possible to specify several statuses by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'indexUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related index. By default, when `indexUids` query parameter is not set, the tasks of all the indexes are returned. It is possible to specify several indexes by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'afterEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'beforeEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'afterStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'beforeStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'afterFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'beforeFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_chat' =>
  array (
    'slug' => 'meilisearch_chat',
    'class' => 'MeilisearchChat',
    'type' => 'write',
    'name' => 'Request a chat completion',
    'description' => 'Request a chat completion',
    'operation_id' => 'chat',
    'method' => 'POST',
    'path' => '/chats/{workspace_uid}/chat/completions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_clear_all_documents' =>
  array (
    'slug' => 'meilisearch_clear_all_documents',
    'class' => 'MeilisearchClearAllDocuments',
    'type' => 'write',
    'name' => 'Delete all documents',
    'description' => 'Permanently delete all documents in the specified index. Settings and index metadata are preserved.',
    'operation_id' => 'clear_all_documents',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/documents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_compact' =>
  array (
    'slug' => 'meilisearch_compact',
    'class' => 'MeilisearchCompact',
    'type' => 'write',
    'name' => 'Compact index',
    'description' => 'Trigger a compaction process on the specified index. Compaction reorganizes the index database to reclaim space and improve read performance.',
    'operation_id' => 'compact',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/compact',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_compact_task_queue' =>
  array (
    'slug' => 'meilisearch_compact_task_queue',
    'class' => 'MeilisearchCompactTaskQueue',
    'type' => 'write',
    'name' => 'Compact task queue',
    'description' => 'Trigger a compaction process on the task queue database and return its size before and after compaction. A successful compaction requires restarting the instance before it can safely resume normal writes.',
    'operation_id' => 'compact_task_queue',
    'method' => 'POST',
    'path' => '/tasks/compact',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_create_api_key' =>
  array (
    'slug' => 'meilisearch_create_api_key',
    'class' => 'MeilisearchCreateApiKey',
    'type' => 'write',
    'name' => 'Create API key',
    'description' => 'Create a new API key with the specified name, description, actions, and index scopes. The key value is returned only once at creation time; store it securely.',
    'operation_id' => 'create_api_key',
    'method' => 'POST',
    'path' => '/keys',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_create_dump' =>
  array (
    'slug' => 'meilisearch_create_dump',
    'class' => 'MeilisearchCreateDump',
    'type' => 'write',
    'name' => 'Create dump',
    'description' => 'Trigger a dump creation process. When complete, a dump file is written to the [dump directory](https://www.meilisearch.com/docs/learn/self_hosted/configure_meilisearch_at_launch#dump-directory). The directory is created if it does not exist.',
    'operation_id' => 'create_dump',
    'method' => 'POST',
    'path' => '/dumps',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_create_index' =>
  array (
    'slug' => 'meilisearch_create_index',
    'class' => 'MeilisearchCreateIndex',
    'type' => 'write',
    'name' => 'Create index',
    'description' => 'Create a new index with an optional [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key). If no primary key is provided, Meilisearch will [infer one](https://www.meilisearch.com/docs/learn/getting_started/primary_key#meilisearch-guesses-your-primary-key) from the first batch of documents.',
    'operation_id' => 'create_index',
    'method' => 'POST',
    'path' => '/indexes',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_create_snapshot' =>
  array (
    'slug' => 'meilisearch_create_snapshot',
    'class' => 'MeilisearchCreateSnapshot',
    'type' => 'write',
    'name' => 'Create snapshot',
    'description' => 'Trigger a snapshot creation process. When complete, a snapshot file is written to the snapshot directory. The directory is created if it does not exist.',
    'operation_id' => 'create_snapshot',
    'method' => 'POST',
    'path' => '/snapshots',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_all' =>
  array (
    'slug' => 'meilisearch_delete_all',
    'class' => 'MeilisearchDeleteAll',
    'type' => 'write',
    'name' => 'Reset all settings',
    'description' => 'Resets all settings of the index to their default values.',
    'operation_id' => 'delete_all',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_api_key' =>
  array (
    'slug' => 'meilisearch_delete_api_key',
    'class' => 'MeilisearchDeleteApiKey',
    'type' => 'write',
    'name' => 'Delete API key',
    'description' => 'Permanently delete the specified API key. The key will no longer be valid for authentication.',
    'operation_id' => 'delete_api_key',
    'method' => 'DELETE',
    'path' => '/keys/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'The `uid` or `key` field of an existing API key.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_chat' =>
  array (
    'slug' => 'meilisearch_delete_chat',
    'class' => 'MeilisearchDeleteChat',
    'type' => 'write',
    'name' => 'Delete a chat workspace',
    'description' => 'Delete a chat workspace',
    'operation_id' => 'delete_chat',
    'method' => 'DELETE',
    'path' => '/chats/{workspace_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_document' =>
  array (
    'slug' => 'meilisearch_delete_document',
    'class' => 'MeilisearchDeleteDocument',
    'type' => 'write',
    'name' => 'Delete document',
    'description' => 'Delete a single document by its [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key).',
    'operation_id' => 'delete_document',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/documents/{document_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'description' => 'Document identifier.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_documents_batch' =>
  array (
    'slug' => 'meilisearch_delete_documents_batch',
    'class' => 'MeilisearchDeleteDocumentsBatch',
    'type' => 'write',
    'name' => 'Delete documents by batch',
    'description' => 'Delete multiple documents in one request by providing an array of [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) values.',
    'operation_id' => 'delete_documents_batch',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/documents/delete-batch',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_delete_documents_by_filter' =>
  array (
    'slug' => 'meilisearch_delete_documents_by_filter',
    'class' => 'MeilisearchDeleteDocumentsByFilter',
    'type' => 'write',
    'name' => 'Delete documents by filter',
    'description' => 'Delete all documents in the index that match the given filter expression.',
    'operation_id' => 'delete_documents_by_filter',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/documents/delete',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_delete_index' =>
  array (
    'slug' => 'meilisearch_delete_index',
    'class' => 'MeilisearchDeleteIndex',
    'type' => 'write',
    'name' => 'Delete index',
    'description' => 'Permanently delete an index and all its documents, settings, and task history.',
    'operation_id' => 'delete_index',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_rule' =>
  array (
    'slug' => 'meilisearch_delete_rule',
    'class' => 'MeilisearchDeleteRule',
    'type' => 'write',
    'name' => 'Delete a search rule',
    'description' => 'Delete a search rule by its unique identifier.',
    'operation_id' => 'delete_rule',
    'method' => 'DELETE',
    'path' => '/dynamic-search-rules/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the search rule.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_tasks' =>
  array (
    'slug' => 'meilisearch_delete_tasks',
    'class' => 'MeilisearchDeleteTasks',
    'type' => 'write',
    'name' => 'Delete tasks',
    'description' => 'Permanently delete [tasks](https://docs.meilisearch.com/learn/advanced/asynchronous_operations.html) matching the given filters. You must provide at least one filter (e.g. `uids`, `indexUids`, `statuses`) to specify which tasks to delete.',
    'operation_id' => 'delete_tasks',
    'method' => 'DELETE',
    'path' => '/tasks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to select tasks by their uid. When the `uids` query parameter is set to `*`, all task uids included. It\'s possible to specify several uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'batchUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Lets you filter tasks by their `batchUid`.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'canceledBy',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks using the uid of the task that canceled them. It\'s possible to specify several task uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'types',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related type. By default, when `types` query parameter is not set, all task types are returned. It\'s possible to specify several types by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'statuses',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their status. By default, when `statuses` query parameter is not set, all task statuses are returned. It\'s possible to specify several statuses by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'indexUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related index. By default, when `indexUids` query parameter is not set, the tasks of all the indexes are returned. It is possible to specify several indexes by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'afterEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'beforeEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'afterStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      9 =>
      array (
        'name' => 'beforeStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'afterFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'beforeFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_delete_webhook' =>
  array (
    'slug' => 'meilisearch_delete_webhook',
    'class' => 'MeilisearchDeleteWebhook',
    'type' => 'write',
    'name' => 'Delete webhook',
    'description' => 'Permanently remove a webhook by its UUID. The webhook will no longer receive task notifications.',
    'operation_id' => 'delete_webhook',
    'method' => 'DELETE',
    'path' => '/webhooks/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Universally unique identifier of the webhook.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletechat' =>
  array (
    'slug' => 'meilisearch_deletechat',
    'class' => 'MeilisearchDeleteChatSetting',
    'type' => 'write',
    'name' => 'Reset chat',
    'description' => 'Resets the `chat` setting to its default value.',
    'operation_id' => 'deletechat',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/chat',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletedictionary' =>
  array (
    'slug' => 'meilisearch_deletedictionary',
    'class' => 'MeilisearchDeletedictionary',
    'type' => 'write',
    'name' => 'Reset dictionary',
    'description' => 'Resets the `dictionary` setting to its default value.',
    'operation_id' => 'deletedictionary',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/dictionary',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletedisplayed_attributes' =>
  array (
    'slug' => 'meilisearch_deletedisplayed_attributes',
    'class' => 'MeilisearchDeletedisplayedAttributes',
    'type' => 'write',
    'name' => 'Reset displayedAttributes',
    'description' => 'Resets the `displayedAttributes` setting to its default value.',
    'operation_id' => 'deletedisplayedAttributes',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/displayed-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletedistinct_attribute' =>
  array (
    'slug' => 'meilisearch_deletedistinct_attribute',
    'class' => 'MeilisearchDeletedistinctAttribute',
    'type' => 'write',
    'name' => 'Reset distinctAttribute',
    'description' => 'Resets the `distinctAttribute` setting to its default value.',
    'operation_id' => 'deletedistinctAttribute',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/distinct-attribute',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteembedders' =>
  array (
    'slug' => 'meilisearch_deleteembedders',
    'class' => 'MeilisearchDeleteembedders',
    'type' => 'write',
    'name' => 'Reset embedders',
    'description' => 'Resets the `embedders` setting to its default value.',
    'operation_id' => 'deleteembedders',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/embedders',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletefacet_search' =>
  array (
    'slug' => 'meilisearch_deletefacet_search',
    'class' => 'MeilisearchDeletefacetSearch',
    'type' => 'write',
    'name' => 'Reset facetSearch',
    'description' => 'Resets the `facetSearch` setting to its default value.',
    'operation_id' => 'deletefacetSearch',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/facet-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletefaceting' =>
  array (
    'slug' => 'meilisearch_deletefaceting',
    'class' => 'MeilisearchDeletefaceting',
    'type' => 'write',
    'name' => 'Reset faceting',
    'description' => 'Resets the `faceting` setting to its default value.',
    'operation_id' => 'deletefaceting',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/faceting',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletefilterable_attributes' =>
  array (
    'slug' => 'meilisearch_deletefilterable_attributes',
    'class' => 'MeilisearchDeletefilterableAttributes',
    'type' => 'write',
    'name' => 'Reset filterableAttributes',
    'description' => 'Resets the `filterableAttributes` setting to its default value.',
    'operation_id' => 'deletefilterableAttributes',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/filterable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteforeign_keys' =>
  array (
    'slug' => 'meilisearch_deleteforeign_keys',
    'class' => 'MeilisearchDeleteforeignKeys',
    'type' => 'write',
    'name' => 'Reset foreignKeys',
    'description' => 'Resets the `foreignKeys` setting to its default value.',
    'operation_id' => 'deleteforeignKeys',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/foreign-keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletelocalized_attributes' =>
  array (
    'slug' => 'meilisearch_deletelocalized_attributes',
    'class' => 'MeilisearchDeletelocalizedAttributes',
    'type' => 'write',
    'name' => 'Reset localizedAttributes',
    'description' => 'Resets the `localizedAttributes` setting to its default value.',
    'operation_id' => 'deletelocalizedAttributes',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/localized-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletenon_separator_tokens' =>
  array (
    'slug' => 'meilisearch_deletenon_separator_tokens',
    'class' => 'MeilisearchDeletenonSeparatorTokens',
    'type' => 'write',
    'name' => 'Reset nonSeparatorTokens',
    'description' => 'Resets the `nonSeparatorTokens` setting to its default value.',
    'operation_id' => 'deletenonSeparatorTokens',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/non-separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletepagination' =>
  array (
    'slug' => 'meilisearch_deletepagination',
    'class' => 'MeilisearchDeletepagination',
    'type' => 'write',
    'name' => 'Reset pagination',
    'description' => 'Resets the `pagination` setting to its default value.',
    'operation_id' => 'deletepagination',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/pagination',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteprefix_search' =>
  array (
    'slug' => 'meilisearch_deleteprefix_search',
    'class' => 'MeilisearchDeleteprefixSearch',
    'type' => 'write',
    'name' => 'Reset prefixSearch',
    'description' => 'Resets the `prefixSearch` setting to its default value.',
    'operation_id' => 'deleteprefixSearch',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/prefix-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteproximity_precision' =>
  array (
    'slug' => 'meilisearch_deleteproximity_precision',
    'class' => 'MeilisearchDeleteproximityPrecision',
    'type' => 'write',
    'name' => 'Reset proximityPrecision',
    'description' => 'Resets the `proximityPrecision` setting to its default value.',
    'operation_id' => 'deleteproximityPrecision',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/proximity-precision',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteranking_rules' =>
  array (
    'slug' => 'meilisearch_deleteranking_rules',
    'class' => 'MeilisearchDeleterankingRules',
    'type' => 'write',
    'name' => 'Reset rankingRules',
    'description' => 'Resets the `rankingRules` setting to its default value.',
    'operation_id' => 'deleterankingRules',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/ranking-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletesearch_cutoff_ms' =>
  array (
    'slug' => 'meilisearch_deletesearch_cutoff_ms',
    'class' => 'MeilisearchDeletesearchCutoffMs',
    'type' => 'write',
    'name' => 'Reset searchCutoffMs',
    'description' => 'Resets the `searchCutoffMs` setting to its default value.',
    'operation_id' => 'deletesearchCutoffMs',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/search-cutoff-ms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletesearchable_attributes' =>
  array (
    'slug' => 'meilisearch_deletesearchable_attributes',
    'class' => 'MeilisearchDeletesearchableAttributes',
    'type' => 'write',
    'name' => 'Reset searchableAttributes',
    'description' => 'Resets the `searchableAttributes` setting to its default value.',
    'operation_id' => 'deletesearchableAttributes',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/searchable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deleteseparator_tokens' =>
  array (
    'slug' => 'meilisearch_deleteseparator_tokens',
    'class' => 'MeilisearchDeleteseparatorTokens',
    'type' => 'write',
    'name' => 'Reset separatorTokens',
    'description' => 'Resets the `separatorTokens` setting to its default value.',
    'operation_id' => 'deleteseparatorTokens',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletesortable_attributes' =>
  array (
    'slug' => 'meilisearch_deletesortable_attributes',
    'class' => 'MeilisearchDeletesortableAttributes',
    'type' => 'write',
    'name' => 'Reset sortableAttributes',
    'description' => 'Resets the `sortableAttributes` setting to its default value.',
    'operation_id' => 'deletesortableAttributes',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/sortable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletestop_words' =>
  array (
    'slug' => 'meilisearch_deletestop_words',
    'class' => 'MeilisearchDeletestopWords',
    'type' => 'write',
    'name' => 'Reset stopWords',
    'description' => 'Resets the `stopWords` setting to its default value.',
    'operation_id' => 'deletestopWords',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/stop-words',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletesynonyms' =>
  array (
    'slug' => 'meilisearch_deletesynonyms',
    'class' => 'MeilisearchDeletesynonyms',
    'type' => 'write',
    'name' => 'Reset synonyms',
    'description' => 'Resets the `synonyms` setting to its default value.',
    'operation_id' => 'deletesynonyms',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/synonyms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_deletetypo_tolerance' =>
  array (
    'slug' => 'meilisearch_deletetypo_tolerance',
    'class' => 'MeilisearchDeletetypoTolerance',
    'type' => 'write',
    'name' => 'Reset typoTolerance',
    'description' => 'Resets the `typoTolerance` setting to its default value.',
    'operation_id' => 'deletetypoTolerance',
    'method' => 'DELETE',
    'path' => '/indexes/{index_uid}/settings/typo-tolerance',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_documents_by_query_post' =>
  array (
    'slug' => 'meilisearch_documents_by_query_post',
    'class' => 'MeilisearchDocumentsByQueryPost',
    'type' => 'write',
    'name' => 'List documents with POST',
    'description' => 'Retrieve a set of documents with optional filtering, sorting, and pagination. Use the request body to specify filters, sort order, and which fields to return.',
    'operation_id' => 'documents_by_query_post',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/documents/fetch',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_edit_documents_by_function' =>
  array (
    'slug' => 'meilisearch_edit_documents_by_function',
    'class' => 'MeilisearchEditDocumentsByFunction',
    'type' => 'write',
    'name' => 'Edit documents by function',
    'description' => 'Use a [RHAI function](https://rhai.rs/book/engine/hello-world.html) to edit one or more documents directly in Meilisearch. The function receives each document and returns the modified document. This feature is experimental and must be enabled through the experimental route.',
    'operation_id' => 'edit_documents_by_function',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/documents/edit',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_export' =>
  array (
    'slug' => 'meilisearch_export',
    'class' => 'MeilisearchExport',
    'type' => 'write',
    'name' => 'Export to a remote Meilisearch',
    'description' => 'Trigger an export that sends documents and settings from this instance to a remote Meilisearch server. Configure the remote URL and optional API key in the request body.',
    'operation_id' => 'export',
    'method' => 'POST',
    'path' => '/export',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_get_all' =>
  array (
    'slug' => 'meilisearch_get_all',
    'class' => 'MeilisearchGetAll',
    'type' => 'read',
    'name' => 'List all settings',
    'description' => 'Returns all settings of the index. Each setting is returned with its current value or the default if not set.',
    'operation_id' => 'get_all',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_api_key' =>
  array (
    'slug' => 'meilisearch_get_api_key',
    'class' => 'MeilisearchGetApiKey',
    'type' => 'read',
    'name' => 'Get API key',
    'description' => 'Retrieve a single API key by its `uid` or by its `key` value.',
    'operation_id' => 'get_api_key',
    'method' => 'GET',
    'path' => '/keys/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'The `uid` or `key` field of an existing API key.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_batch' =>
  array (
    'slug' => 'meilisearch_get_batch',
    'class' => 'MeilisearchGetBatch',
    'type' => 'read',
    'name' => 'Get batch',
    'description' => 'Meilisearch groups compatible tasks ([asynchronous operations](https://www.meilisearch.com/docs/learn/async/asynchronous_operations)) into batches for efficient processing. For example, multiple document additions to the same index may be batched together. Retrieve a single batch by its unique identifier to monitor its progress and performance.',
    'operation_id' => 'get_batch',
    'method' => 'GET',
    'path' => '/batches/{batch_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'batch_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique batch identifier.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_batches' =>
  array (
    'slug' => 'meilisearch_get_batches',
    'class' => 'MeilisearchGetBatches',
    'type' => 'read',
    'name' => 'List batches',
    'description' => 'Meilisearch groups compatible tasks ([asynchronous operations](https://www.meilisearch.com/docs/learn/async/asynchronous_operations)) into batches for efficient processing. For example, multiple document additions to the same index may be batched together. List batches to monitor their progress and performance. Batches are always returned in descending order of uid. This means that by default, the most recently created batch objects appear first. Batch results are paginated and can be filtered with query parameters.',
    'operation_id' => 'get_batches',
    'method' => 'GET',
    'path' => '/batches',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of batches to return.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => false,
        'description' => '`uid` of the first batch returned.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'reverse',
        'in' => 'query',
        'required' => false,
        'description' => 'If `true`, returns results in the reverse order, from oldest to most recent.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'batchUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their batch uid. By default, when the `batchUids` query parameter is not set, all task uids are returned. It\'s possible to specify several batch uids by separating them with the `,` character.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'uids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their uid. By default, when the uids query parameter is not set, all task uids are returned. It\'s possible to specify several uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'canceledBy',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks using the uid of the task that canceled them. It\'s possible to specify several task uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'types',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related type. By default, when `types` query parameter is not set, all task types are returned. It\'s possible to specify several types by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'statuses',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their status. By default, when `statuses` query parameter is not set, all task statuses are returned. It\'s possible to specify several statuses by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'indexUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related index. By default, when `indexUids` query parameter is not set, the tasks of all the indexes are returned. It is possible to specify several indexes by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'afterEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'beforeEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'afterStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      12 =>
      array (
        'name' => 'beforeStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      13 =>
      array (
        'name' => 'afterFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      14 =>
      array (
        'name' => 'beforeFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_chat' =>
  array (
    'slug' => 'meilisearch_get_chat',
    'class' => 'MeilisearchGetChat',
    'type' => 'read',
    'name' => 'Get a chat workspace',
    'description' => 'Get a chat workspace',
    'operation_id' => 'get_chat',
    'method' => 'GET',
    'path' => '/chats/{workspace_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_document' =>
  array (
    'slug' => 'meilisearch_get_document',
    'class' => 'MeilisearchGetDocument',
    'type' => 'read',
    'name' => 'Get document',
    'description' => 'Retrieve a single document by its [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) value.',
    'operation_id' => 'get_document',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/documents/{document_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'document_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The document identifier.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'description' => 'Comma-separated list of document attributes to include in the response. Use `*` to retrieve all attributes. By default, all attributes listed in the `displayedAttributes` setting are returned. Example: `title,description,price`.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'retrieveVectors',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes the vector embeddings in the response for this document. This is useful when you need to inspect or export vector data. Note that this can significantly increase response size if the document has multiple embedders configured. Defaults to `false`.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_documents' =>
  array (
    'slug' => 'meilisearch_get_documents',
    'class' => 'MeilisearchGetDocuments',
    'type' => 'read',
    'name' => 'List documents with GET',
    'description' => 'Retrieve documents in batches using query parameters for offset, limit, and optional filtering. Suited for browsing or exporting index contents.',
    'operation_id' => 'get_documents',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/documents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of documents to skip in the response. Use this parameter together with `limit` to paginate through large document sets. For example, to get documents 21-40, set `offset=20` and `limit=20`. Defaults to `0`.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of documents to return in a single response. Use together with `offset` for pagination. Defaults to `20`.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'fields',
        'in' => 'query',
        'required' => false,
        'description' => 'Comma-separated list of document attributes to include in the response. Use `*` to retrieve all attributes. By default, all attributes are returned. Example: `title,description,price`.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'retrieveVectors',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes vector embeddings in the response for documents that have them. This is useful when you need to inspect or export vector data. Defaults to `false`.',
        'schema_type' => 'boolean',
      ),
      5 =>
      array (
        'name' => 'ids',
        'in' => 'query',
        'required' => false,
        'description' => 'Comma-separated list of document IDs to retrieve. Only documents with matching IDs will be returned. If not specified, all documents matching other criteria are returned.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter expression to select which documents to return. Uses the same syntax as search filters. Only documents matching the filter will be included in the response. Example: `genres = action AND rating > 4`.',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Attribute(s) to sort the documents by. Format: `attribute:asc` or `attribute:desc`. Multiple sort criteria can be comma-separated. Example: `price:asc,rating:desc`.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_features' =>
  array (
    'slug' => 'meilisearch_get_features',
    'class' => 'MeilisearchGetFeatures',
    'type' => 'read',
    'name' => 'List experimental features',
    'description' => 'Return all experimental features that can be toggled via this API, and whether each one is currently enabled or disabled.',
    'operation_id' => 'get_features',
    'method' => 'GET',
    'path' => '/experimental-features',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_health' =>
  array (
    'slug' => 'meilisearch_get_health',
    'class' => 'MeilisearchGetHealth',
    'type' => 'read',
    'name' => 'Get health',
    'description' => 'The health check endpoint enables you to periodically test the health of your Meilisearch instance. Returns a simple status indicating that the server is available.',
    'operation_id' => 'get_health',
    'method' => 'GET',
    'path' => '/health',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_index' =>
  array (
    'slug' => 'meilisearch_get_index',
    'class' => 'MeilisearchGetIndex',
    'type' => 'read',
    'name' => 'Get index',
    'description' => 'Retrieve the metadata of a single index: its uid, [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key), and creation/update timestamps.',
    'operation_id' => 'get_index',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_index_stats' =>
  array (
    'slug' => 'meilisearch_get_index_stats',
    'class' => 'MeilisearchGetIndexStats',
    'type' => 'read',
    'name' => 'Get stats of index',
    'description' => 'Return statistics for a single index: document count, database size, indexing status, and field distribution.',
    'operation_id' => 'get_index_stats',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/stats',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_logs' =>
  array (
    'slug' => 'meilisearch_get_logs',
    'class' => 'MeilisearchGetLogs',
    'type' => 'write',
    'name' => 'Retrieve logs',
    'description' => 'Stream logs over HTTP. The format of the logs depends on the configuration specified in the payload. The logs are sent as multi-part, and the stream never stops, so ensure your client can handle a long-lived connection. To stop receiving logs, call the `DELETE /logs/stream` route. Only one client can listen at a time. An error is returned if you call this route while it is already in use by another client.',
    'operation_id' => 'get_logs',
    'method' => 'POST',
    'path' => '/logs/stream',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_get_metrics' =>
  array (
    'slug' => 'meilisearch_get_metrics',
    'class' => 'MeilisearchGetMetrics',
    'type' => 'read',
    'name' => 'Get Prometheus metrics',
    'description' => 'Return metrics for the engine in Prometheus format. This is an [experimental feature](https://www.meilisearch.com/docs/learn/experimental/overview) and must be enabled before use.',
    'operation_id' => 'get_metrics',
    'method' => 'GET',
    'path' => '/metrics',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_network' =>
  array (
    'slug' => 'meilisearch_get_network',
    'class' => 'MeilisearchGetNetwork',
    'type' => 'read',
    'name' => 'Get network topology',
    'description' => 'Return the list of Meilisearch instances currently known to this node (self and remotes).',
    'operation_id' => 'get_network',
    'method' => 'GET',
    'path' => '/network',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_rule' =>
  array (
    'slug' => 'meilisearch_get_rule',
    'class' => 'MeilisearchGetRule',
    'type' => 'read',
    'name' => 'Get a search rule',
    'description' => 'Retrieve a single search rule by its unique identifier.',
    'operation_id' => 'get_rule',
    'method' => 'GET',
    'path' => '/dynamic-search-rules/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the search rule.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_settings' =>
  array (
    'slug' => 'meilisearch_get_settings',
    'class' => 'MeilisearchGetSettings',
    'type' => 'read',
    'name' => 'Get settings of a chat workspace',
    'description' => 'Get settings of a chat workspace',
    'operation_id' => 'get_settings',
    'method' => 'GET',
    'path' => '/chats/{workspace_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_stats' =>
  array (
    'slug' => 'meilisearch_get_stats',
    'class' => 'MeilisearchGetStats',
    'type' => 'read',
    'name' => 'Get stats of all indexes',
    'description' => 'Return statistics for the Meilisearch instance and for each index. Includes database size, last update time, document counts, and indexing status per index.',
    'operation_id' => 'get_stats',
    'method' => 'GET',
    'path' => '/stats',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_task' =>
  array (
    'slug' => 'meilisearch_get_task',
    'class' => 'MeilisearchGetTask',
    'type' => 'read',
    'name' => 'Get task',
    'description' => 'Retrieve a single [task](https://www.meilisearch.com/docs/learn/async/asynchronous_operations) by its uid.',
    'operation_id' => 'get_task',
    'method' => 'GET',
    'path' => '/tasks/{task_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'task_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The task identifier.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_task_documents_file' =>
  array (
    'slug' => 'meilisearch_get_task_documents_file',
    'class' => 'MeilisearchGetTaskDocumentsFile',
    'type' => 'read',
    'name' => 'Get task\'s document payload',
    'description' => 'Retrieve the document payload that was sent with this [task](https://www.meilisearch.com/docs/learn/async/asynchronous_operations). Only available for document-related tasks that are enqueued or processing.',
    'operation_id' => 'get_task_documents_file',
    'method' => 'GET',
    'path' => '/tasks/{task_id}/documents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'task_id',
        'in' => 'path',
        'required' => true,
        'description' => 'The task identifier.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_tasks' =>
  array (
    'slug' => 'meilisearch_get_tasks',
    'class' => 'MeilisearchGetTasks',
    'type' => 'read',
    'name' => 'List tasks',
    'description' => 'The `/tasks` route returns information about [asynchronous operations](https://docs.meilisearch.com/learn/advanced/asynchronous_operations.html) (indexing, document updates, settings changes, and so on). Tasks are returned in descending order of uid by default, so the most recently created or updated tasks appear first. Results are paginated and can be filtered using query parameters such as `indexUids`, `statuses`, `types`, and date ranges.',
    'operation_id' => 'get_tasks',
    'method' => 'GET',
    'path' => '/tasks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of batches to return.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'from',
        'in' => 'query',
        'required' => false,
        'description' => '`uid` of the first batch returned.',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'reverse',
        'in' => 'query',
        'required' => false,
        'description' => 'If `true`, returns results in the reverse order, from oldest to most recent.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'batchUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their batch uid. By default, when the `batchUids` query parameter is not set, all task uids are returned. It\'s possible to specify several batch uids by separating them with the `,` character.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'uids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their uid. By default, when the uids query parameter is not set, all task uids are returned. It\'s possible to specify several uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'canceledBy',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks using the uid of the task that canceled them. It\'s possible to specify several task uids by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'types',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related type. By default, when `types` query parameter is not set, all task types are returned. It\'s possible to specify several types by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'statuses',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their status. By default, when `statuses` query parameter is not set, all task statuses are returned. It\'s possible to specify several statuses by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'indexUids',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks by their related index. By default, when `indexUids` query parameter is not set, the tasks of all the indexes are returned. It is possible to specify several indexes by separating them with the `,` character.',
        'schema_type' => 'array',
      ),
      9 =>
      array (
        'name' => 'afterEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'beforeEnqueuedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their enqueuedAt time. Matches tasks enqueued before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      11 =>
      array (
        'name' => 'afterStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      12 =>
      array (
        'name' => 'beforeStartedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their startedAt time. Matches tasks started before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      13 =>
      array (
        'name' => 'afterFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished after the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
      14 =>
      array (
        'name' => 'beforeFinishedAt',
        'in' => 'query',
        'required' => false,
        'description' => 'Permits to filter tasks based on their finishedAt time. Matches tasks finished before the given date. Supports RFC 3339 date format.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_version' =>
  array (
    'slug' => 'meilisearch_get_version',
    'class' => 'MeilisearchGetVersion',
    'type' => 'read',
    'name' => 'Get version',
    'description' => 'Return the current Meilisearch version, including the commit SHA and build date.',
    'operation_id' => 'get_version',
    'method' => 'GET',
    'path' => '/version',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_webhook' =>
  array (
    'slug' => 'meilisearch_get_webhook',
    'class' => 'MeilisearchGetWebhook',
    'type' => 'read',
    'name' => 'Get webhook',
    'description' => 'Retrieve a single webhook by its UUID.',
    'operation_id' => 'get_webhook',
    'method' => 'GET',
    'path' => '/webhooks/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Universally unique identifier of the webhook.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_get_webhooks' =>
  array (
    'slug' => 'meilisearch_get_webhooks',
    'class' => 'MeilisearchGetWebhooks',
    'type' => 'read',
    'name' => 'List webhooks',
    'description' => 'Return all webhooks registered on the instance. Each webhook is returned with its URL, optional headers, and UUID (the key value is never returned).',
    'operation_id' => 'get_webhooks',
    'method' => 'GET',
    'path' => '/webhooks',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getchat' =>
  array (
    'slug' => 'meilisearch_getchat',
    'class' => 'MeilisearchGetChatSetting',
    'type' => 'read',
    'name' => 'Get chat',
    'description' => 'Returns the current value of the `chat` setting for the index.',
    'operation_id' => 'getchat',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/chat',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getdictionary' =>
  array (
    'slug' => 'meilisearch_getdictionary',
    'class' => 'MeilisearchGetdictionary',
    'type' => 'read',
    'name' => 'Get dictionary',
    'description' => 'Returns the current value of the `dictionary` setting for the index.',
    'operation_id' => 'getdictionary',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/dictionary',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getdisplayed_attributes' =>
  array (
    'slug' => 'meilisearch_getdisplayed_attributes',
    'class' => 'MeilisearchGetdisplayedAttributes',
    'type' => 'read',
    'name' => 'Get displayedAttributes',
    'description' => 'Returns the current value of the `displayedAttributes` setting for the index.',
    'operation_id' => 'getdisplayedAttributes',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/displayed-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getdistinct_attribute' =>
  array (
    'slug' => 'meilisearch_getdistinct_attribute',
    'class' => 'MeilisearchGetdistinctAttribute',
    'type' => 'read',
    'name' => 'Get distinctAttribute',
    'description' => 'Returns the current value of the `distinctAttribute` setting for the index.',
    'operation_id' => 'getdistinctAttribute',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/distinct-attribute',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getembedders' =>
  array (
    'slug' => 'meilisearch_getembedders',
    'class' => 'MeilisearchGetembedders',
    'type' => 'read',
    'name' => 'Get embedders',
    'description' => 'Returns the current value of the `embedders` setting for the index.',
    'operation_id' => 'getembedders',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/embedders',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getfacet_search' =>
  array (
    'slug' => 'meilisearch_getfacet_search',
    'class' => 'MeilisearchGetfacetSearch',
    'type' => 'read',
    'name' => 'Get facetSearch',
    'description' => 'Returns the current value of the `facetSearch` setting for the index.',
    'operation_id' => 'getfacetSearch',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/facet-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getfaceting' =>
  array (
    'slug' => 'meilisearch_getfaceting',
    'class' => 'MeilisearchGetfaceting',
    'type' => 'read',
    'name' => 'Get faceting',
    'description' => 'Returns the current value of the `faceting` setting for the index.',
    'operation_id' => 'getfaceting',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/faceting',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getfilterable_attributes' =>
  array (
    'slug' => 'meilisearch_getfilterable_attributes',
    'class' => 'MeilisearchGetfilterableAttributes',
    'type' => 'read',
    'name' => 'Get filterableAttributes',
    'description' => 'Returns the current value of the `filterableAttributes` setting for the index.',
    'operation_id' => 'getfilterableAttributes',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/filterable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getforeign_keys' =>
  array (
    'slug' => 'meilisearch_getforeign_keys',
    'class' => 'MeilisearchGetforeignKeys',
    'type' => 'read',
    'name' => 'Get foreignKeys',
    'description' => 'Returns the current value of the `foreignKeys` setting for the index.',
    'operation_id' => 'getforeignKeys',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/foreign-keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getlocalized_attributes' =>
  array (
    'slug' => 'meilisearch_getlocalized_attributes',
    'class' => 'MeilisearchGetlocalizedAttributes',
    'type' => 'read',
    'name' => 'Get localizedAttributes',
    'description' => 'Returns the current value of the `localizedAttributes` setting for the index.',
    'operation_id' => 'getlocalizedAttributes',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/localized-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getnon_separator_tokens' =>
  array (
    'slug' => 'meilisearch_getnon_separator_tokens',
    'class' => 'MeilisearchGetnonSeparatorTokens',
    'type' => 'read',
    'name' => 'Get nonSeparatorTokens',
    'description' => 'Returns the current value of the `nonSeparatorTokens` setting for the index.',
    'operation_id' => 'getnonSeparatorTokens',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/non-separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getpagination' =>
  array (
    'slug' => 'meilisearch_getpagination',
    'class' => 'MeilisearchGetpagination',
    'type' => 'read',
    'name' => 'Get pagination',
    'description' => 'Returns the current value of the `pagination` setting for the index.',
    'operation_id' => 'getpagination',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/pagination',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getprefix_search' =>
  array (
    'slug' => 'meilisearch_getprefix_search',
    'class' => 'MeilisearchGetprefixSearch',
    'type' => 'read',
    'name' => 'Get prefixSearch',
    'description' => 'Returns the current value of the `prefixSearch` setting for the index.',
    'operation_id' => 'getprefixSearch',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/prefix-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getproximity_precision' =>
  array (
    'slug' => 'meilisearch_getproximity_precision',
    'class' => 'MeilisearchGetproximityPrecision',
    'type' => 'read',
    'name' => 'Get proximityPrecision',
    'description' => 'Returns the current value of the `proximityPrecision` setting for the index.',
    'operation_id' => 'getproximityPrecision',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/proximity-precision',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getranking_rules' =>
  array (
    'slug' => 'meilisearch_getranking_rules',
    'class' => 'MeilisearchGetrankingRules',
    'type' => 'read',
    'name' => 'Get rankingRules',
    'description' => 'Returns the current value of the `rankingRules` setting for the index.',
    'operation_id' => 'getrankingRules',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/ranking-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getsearch_cutoff_ms' =>
  array (
    'slug' => 'meilisearch_getsearch_cutoff_ms',
    'class' => 'MeilisearchGetsearchCutoffMs',
    'type' => 'read',
    'name' => 'Get searchCutoffMs',
    'description' => 'Returns the current value of the `searchCutoffMs` setting for the index.',
    'operation_id' => 'getsearchCutoffMs',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/search-cutoff-ms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getsearchable_attributes' =>
  array (
    'slug' => 'meilisearch_getsearchable_attributes',
    'class' => 'MeilisearchGetsearchableAttributes',
    'type' => 'read',
    'name' => 'Get searchableAttributes',
    'description' => 'Returns the current value of the `searchableAttributes` setting for the index.',
    'operation_id' => 'getsearchableAttributes',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/searchable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getseparator_tokens' =>
  array (
    'slug' => 'meilisearch_getseparator_tokens',
    'class' => 'MeilisearchGetseparatorTokens',
    'type' => 'read',
    'name' => 'Get separatorTokens',
    'description' => 'Returns the current value of the `separatorTokens` setting for the index.',
    'operation_id' => 'getseparatorTokens',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getsortable_attributes' =>
  array (
    'slug' => 'meilisearch_getsortable_attributes',
    'class' => 'MeilisearchGetsortableAttributes',
    'type' => 'read',
    'name' => 'Get sortableAttributes',
    'description' => 'Returns the current value of the `sortableAttributes` setting for the index.',
    'operation_id' => 'getsortableAttributes',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/sortable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getstop_words' =>
  array (
    'slug' => 'meilisearch_getstop_words',
    'class' => 'MeilisearchGetstopWords',
    'type' => 'read',
    'name' => 'Get stopWords',
    'description' => 'Returns the current value of the `stopWords` setting for the index.',
    'operation_id' => 'getstopWords',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/stop-words',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_getsynonyms' =>
  array (
    'slug' => 'meilisearch_getsynonyms',
    'class' => 'MeilisearchGetsynonyms',
    'type' => 'read',
    'name' => 'Get synonyms',
    'description' => 'Returns the current value of the `synonyms` setting for the index.',
    'operation_id' => 'getsynonyms',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/synonyms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_gettypo_tolerance' =>
  array (
    'slug' => 'meilisearch_gettypo_tolerance',
    'class' => 'MeilisearchGettypoTolerance',
    'type' => 'read',
    'name' => 'Get typoTolerance',
    'description' => 'Returns the current value of the `typoTolerance` setting for the index.',
    'operation_id' => 'gettypoTolerance',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/settings/typo-tolerance',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_list_api_keys' =>
  array (
    'slug' => 'meilisearch_list_api_keys',
    'class' => 'MeilisearchListApiKeys',
    'type' => 'read',
    'name' => 'List API keys',
    'description' => 'Return all API keys configured on the instance. Results are paginated and can be filtered by offset and limit. The key value itself is never returned after creation.',
    'operation_id' => 'list_api_keys',
    'method' => 'GET',
    'path' => '/keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of keys to skip. Use with `limit` for pagination. Defaults to 0.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of keys to return. Use with `offset` for pagination. Defaults to 20.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_list_indexes' =>
  array (
    'slug' => 'meilisearch_list_indexes',
    'class' => 'MeilisearchListIndexes',
    'type' => 'read',
    'name' => 'List all indexes',
    'description' => 'Returns a paginated list of indexes. Use the `offset` and `limit` query parameters to page through results.',
    'operation_id' => 'list_indexes',
    'method' => 'GET',
    'path' => '/indexes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'description' => 'The number of indexes to skip before starting to retrieve anything.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'The number of indexes to retrieve.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_list_rules' =>
  array (
    'slug' => 'meilisearch_list_rules',
    'class' => 'MeilisearchListRules',
    'type' => 'write',
    'name' => 'List search rules',
    'description' => 'Return all search rules configured on the instance.',
    'operation_id' => 'list_rules',
    'method' => 'POST',
    'path' => '/dynamic-search-rules',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_list_workspaces' =>
  array (
    'slug' => 'meilisearch_list_workspaces',
    'class' => 'MeilisearchListWorkspaces',
    'type' => 'read',
    'name' => 'List chat workspaces',
    'description' => 'List chat workspaces',
    'operation_id' => 'list_workspaces',
    'method' => 'GET',
    'path' => '/chats',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_multi_search_with_post' =>
  array (
    'slug' => 'meilisearch_multi_search_with_post',
    'class' => 'MeilisearchMultiSearchWithPost',
    'type' => 'write',
    'name' => 'Perform a multi-search',
    'description' => 'Run multiple search queries in a single API request. Each query can target a different index, so you can search across several indexes at once and get one combined response.',
    'operation_id' => 'multi_search_with_post',
    'method' => 'POST',
    'path' => '/multi-search',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patch_api_key' =>
  array (
    'slug' => 'meilisearch_patch_api_key',
    'class' => 'MeilisearchPatchApiKey',
    'type' => 'write',
    'name' => 'Update API key',
    'description' => 'Update the name and description of an API key. Updates are partial: only the fields you send are changed, and any fields not present in the payload remain unchanged.',
    'operation_id' => 'patch_api_key',
    'method' => 'PATCH',
    'path' => '/keys/{key}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'key',
        'in' => 'path',
        'required' => true,
        'description' => 'The `uid` or `key` field of an existing API key.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patch_features' =>
  array (
    'slug' => 'meilisearch_patch_features',
    'class' => 'MeilisearchPatchFeatures',
    'type' => 'write',
    'name' => 'Configure experimental features',
    'description' => 'Enable or disable experimental features at runtime.',
    'operation_id' => 'patch_features',
    'method' => 'PATCH',
    'path' => '/experimental-features',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'meilisearch_patch_network' =>
  array (
    'slug' => 'meilisearch_patch_network',
    'class' => 'MeilisearchPatchNetwork',
    'type' => 'write',
    'name' => 'Configure network topology',
    'description' => 'Add or remove remote nodes from the network. Changes apply to the current instance\'s view of the cluster.',
    'operation_id' => 'patch_network',
    'method' => 'PATCH',
    'path' => '/network',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patch_settings' =>
  array (
    'slug' => 'meilisearch_patch_settings',
    'class' => 'MeilisearchPatchSettings',
    'type' => 'write',
    'name' => 'Update settings of a chat workspace',
    'description' => 'Update settings of a chat workspace',
    'operation_id' => 'patch_settings',
    'method' => 'PATCH',
    'path' => '/chats/{workspace_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patch_webhook' =>
  array (
    'slug' => 'meilisearch_patch_webhook',
    'class' => 'MeilisearchPatchWebhook',
    'type' => 'write',
    'name' => 'Update webhook',
    'description' => 'Update the URL or headers of an existing webhook identified by its UUID.',
    'operation_id' => 'patch_webhook',
    'method' => 'PATCH',
    'path' => '/webhooks/{uuid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uuid',
        'in' => 'path',
        'required' => true,
        'description' => 'Universally unique identifier of the webhook.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patchchat' =>
  array (
    'slug' => 'meilisearch_patchchat',
    'class' => 'MeilisearchPatchchat',
    'type' => 'write',
    'name' => 'Update chat',
    'description' => 'Updates the `chat` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'patchchat',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings/chat',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patchembedders' =>
  array (
    'slug' => 'meilisearch_patchembedders',
    'class' => 'MeilisearchPatchembedders',
    'type' => 'write',
    'name' => 'Update embedders',
    'description' => 'Updates the `embedders` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'patchembedders',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings/embedders',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patchfaceting' =>
  array (
    'slug' => 'meilisearch_patchfaceting',
    'class' => 'MeilisearchPatchfaceting',
    'type' => 'write',
    'name' => 'Update faceting',
    'description' => 'Updates the `faceting` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'patchfaceting',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings/faceting',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patchpagination' =>
  array (
    'slug' => 'meilisearch_patchpagination',
    'class' => 'MeilisearchPatchpagination',
    'type' => 'write',
    'name' => 'Update pagination',
    'description' => 'Updates the `pagination` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'patchpagination',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings/pagination',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_patchtypo_tolerance' =>
  array (
    'slug' => 'meilisearch_patchtypo_tolerance',
    'class' => 'MeilisearchPatchtypoTolerance',
    'type' => 'write',
    'name' => 'Update typoTolerance',
    'description' => 'Updates the `typoTolerance` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'patchtypoTolerance',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings/typo-tolerance',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_post_index_fields' =>
  array (
    'slug' => 'meilisearch_post_index_fields',
    'class' => 'MeilisearchPostIndexFields',
    'type' => 'write',
    'name' => 'List index fields',
    'description' => 'Returns a paginated list of fields in the index with their metadata: whether they are displayed, searchable, sortable, filterable, distinct, have a custom ranking rule (asc/desc), and for filterable fields the sort order for facet values.',
    'operation_id' => 'post_index_fields',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/fields',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index whose fields to list.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_post_network_change' =>
  array (
    'slug' => 'meilisearch_post_network_change',
    'class' => 'MeilisearchPostNetworkChange',
    'type' => 'write',
    'name' => 'Network control',
    'description' => 'Send messages to control the progress of a network topology change task. The route is mostly used internally when sending a PATCH to the network, but is accessible for manual control as well.',
    'operation_id' => 'post_network_change',
    'method' => 'POST',
    'path' => '/network/control',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_post_webhook' =>
  array (
    'slug' => 'meilisearch_post_webhook',
    'class' => 'MeilisearchPostWebhook',
    'type' => 'write',
    'name' => 'Create webhook',
    'description' => 'Register a new webhook to receive task completion notifications. You can optionally set custom headers (e.g. for authentication) and configure the callback URL.',
    'operation_id' => 'post_webhook',
    'method' => 'POST',
    'path' => '/webhooks',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putdictionary' =>
  array (
    'slug' => 'meilisearch_putdictionary',
    'class' => 'MeilisearchPutdictionary',
    'type' => 'write',
    'name' => 'Update dictionary',
    'description' => 'Updates the `dictionary` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putdictionary',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/dictionary',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putdisplayed_attributes' =>
  array (
    'slug' => 'meilisearch_putdisplayed_attributes',
    'class' => 'MeilisearchPutdisplayedAttributes',
    'type' => 'write',
    'name' => 'Update displayedAttributes',
    'description' => 'Updates the `displayedAttributes` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putdisplayedAttributes',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/displayed-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putdistinct_attribute' =>
  array (
    'slug' => 'meilisearch_putdistinct_attribute',
    'class' => 'MeilisearchPutdistinctAttribute',
    'type' => 'write',
    'name' => 'Update distinctAttribute',
    'description' => 'Updates the `distinctAttribute` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putdistinctAttribute',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/distinct-attribute',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'text/plain',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putfacet_search' =>
  array (
    'slug' => 'meilisearch_putfacet_search',
    'class' => 'MeilisearchPutfacetSearch',
    'type' => 'write',
    'name' => 'Update facetSearch',
    'description' => 'Updates the `facetSearch` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putfacetSearch',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/facet-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'text/plain',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putfilterable_attributes' =>
  array (
    'slug' => 'meilisearch_putfilterable_attributes',
    'class' => 'MeilisearchPutfilterableAttributes',
    'type' => 'write',
    'name' => 'Update filterableAttributes',
    'description' => 'Updates the `filterableAttributes` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putfilterableAttributes',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/filterable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putforeign_keys' =>
  array (
    'slug' => 'meilisearch_putforeign_keys',
    'class' => 'MeilisearchPutforeignKeys',
    'type' => 'write',
    'name' => 'Update foreignKeys',
    'description' => 'Updates the `foreignKeys` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putforeignKeys',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/foreign-keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putlocalized_attributes' =>
  array (
    'slug' => 'meilisearch_putlocalized_attributes',
    'class' => 'MeilisearchPutlocalizedAttributes',
    'type' => 'write',
    'name' => 'Update localizedAttributes',
    'description' => 'Updates the `localizedAttributes` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putlocalizedAttributes',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/localized-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putnon_separator_tokens' =>
  array (
    'slug' => 'meilisearch_putnon_separator_tokens',
    'class' => 'MeilisearchPutnonSeparatorTokens',
    'type' => 'write',
    'name' => 'Update nonSeparatorTokens',
    'description' => 'Updates the `nonSeparatorTokens` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putnonSeparatorTokens',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/non-separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putprefix_search' =>
  array (
    'slug' => 'meilisearch_putprefix_search',
    'class' => 'MeilisearchPutprefixSearch',
    'type' => 'write',
    'name' => 'Update prefixSearch',
    'description' => 'Updates the `prefixSearch` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putprefixSearch',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/prefix-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putproximity_precision' =>
  array (
    'slug' => 'meilisearch_putproximity_precision',
    'class' => 'MeilisearchPutproximityPrecision',
    'type' => 'write',
    'name' => 'Update proximityPrecision',
    'description' => 'Updates the `proximityPrecision` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putproximityPrecision',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/proximity-precision',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putranking_rules' =>
  array (
    'slug' => 'meilisearch_putranking_rules',
    'class' => 'MeilisearchPutrankingRules',
    'type' => 'write',
    'name' => 'Update rankingRules',
    'description' => 'Updates the `rankingRules` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putrankingRules',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/ranking-rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putsearch_cutoff_ms' =>
  array (
    'slug' => 'meilisearch_putsearch_cutoff_ms',
    'class' => 'MeilisearchPutsearchCutoffMs',
    'type' => 'write',
    'name' => 'Update searchCutoffMs',
    'description' => 'Updates the `searchCutoffMs` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putsearchCutoffMs',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/search-cutoff-ms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'text/plain',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putsearchable_attributes' =>
  array (
    'slug' => 'meilisearch_putsearchable_attributes',
    'class' => 'MeilisearchPutsearchableAttributes',
    'type' => 'write',
    'name' => 'Update searchableAttributes',
    'description' => 'Updates the `searchableAttributes` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putsearchableAttributes',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/searchable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putseparator_tokens' =>
  array (
    'slug' => 'meilisearch_putseparator_tokens',
    'class' => 'MeilisearchPutseparatorTokens',
    'type' => 'write',
    'name' => 'Update separatorTokens',
    'description' => 'Updates the `separatorTokens` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putseparatorTokens',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/separator-tokens',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putsortable_attributes' =>
  array (
    'slug' => 'meilisearch_putsortable_attributes',
    'class' => 'MeilisearchPutsortableAttributes',
    'type' => 'write',
    'name' => 'Update sortableAttributes',
    'description' => 'Updates the `sortableAttributes` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putsortableAttributes',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/sortable-attributes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putstop_words' =>
  array (
    'slug' => 'meilisearch_putstop_words',
    'class' => 'MeilisearchPutstopWords',
    'type' => 'write',
    'name' => 'Update stopWords',
    'description' => 'Updates the `stopWords` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putstopWords',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/stop-words',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_putsynonyms' =>
  array (
    'slug' => 'meilisearch_putsynonyms',
    'class' => 'MeilisearchPutsynonyms',
    'type' => 'write',
    'name' => 'Update synonyms',
    'description' => 'Updates the `synonyms` setting for the index. Send the new value in the request body; send null to reset to default.',
    'operation_id' => 'putsynonyms',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/settings/synonyms',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_reset_settings' =>
  array (
    'slug' => 'meilisearch_reset_settings',
    'class' => 'MeilisearchResetSettings',
    'type' => 'write',
    'name' => 'Reset the settings of a chat workspace',
    'description' => 'Reset the settings of a chat workspace',
    'operation_id' => 'reset_settings',
    'method' => 'DELETE',
    'path' => '/chats/{workspace_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'workspace_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'The unique identifier of the chat workspace.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_search' =>
  array (
    'slug' => 'meilisearch_search',
    'class' => 'MeilisearchSearch',
    'type' => 'write',
    'name' => 'Search in facets',
    'description' => 'Search for facet values within a given facet. > Use this to build autocomplete or refinement UIs for facet filters.',
    'operation_id' => 'search',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/facet-search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_search_documents' =>
  array (
    'slug' => 'meilisearch_search_documents',
    'class' => 'MeilisearchSearchDocuments',
    'type' => 'write',
    'name' => 'Search with POST',
    'description' => 'Search for documents matching a query in the given index. > Equivalent to the [search with GET route](/reference/api/search/search-with-get) in the Meilisearch API.',
    'operation_id' => 'search_with_post',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_search_with_url_query' =>
  array (
    'slug' => 'meilisearch_search_with_url_query',
    'class' => 'MeilisearchSearchWithUrlQuery',
    'type' => 'read',
    'name' => 'Search with GET',
    'description' => 'Search for documents matching a query in the given index. > Equivalent to the [search with POST route](/reference/api/search/search-with-post) in the Meilisearch API.',
    'operation_id' => 'search_with_url_query',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/search',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'q',
        'in' => 'query',
        'required' => false,
        'description' => 'Sets the search terms. Meilisearch returns documents that match this query. The query supports [prefix search](https://www.meilisearch.com/docs/learn/engine/prefix) and [typo tolerance](https://www.meilisearch.com/docs/learn/relevancy/typo_tolerance_settings). Meilisearch only considers the first ten words; terms are normalized (lowercase, accents ignored). Omit or leave empty for a placeholder search: no query terms are applied, so Meilisearch returns all searchable documents in the index, ordered by [ranking rules](https://www.meilisearch.com/docs/learn/relevancy/ranking_rules). Enclose terms in double quotes (`"`) for phrase search: only documents containing that exact sequence of words are returned (e.g. `"Winter Feast"`). Use a minus sign (`-`) before a word or phrase to exclude it from results.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of documents to skip at the start of the results. Use together with `limit` for [pagination](https://www.meilisearch.com/docs/guides/front_end/pagination) (e.g. offset=20 and limit=20 returns results 21-40). This parameter is ignored when `page` or `hitsPerPage` is set; in that case the response includes `totalHits` and `totalPages` instead of `estimatedTotalHits`.',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of documents to return in the response. Use with `offset` for [pagination](https://www.meilisearch.com/docs/guides/front_end/pagination). This parameter is ignored when `page` or `hitsPerPage` is set. The value cannot exceed the index [maxTotalHits](https://www.meilisearch.com/docs/reference/api/settings/update-pagination#body-max-total-hits-one-of-0) setting.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Request a specific results page (1-indexed). Use together with `hitsPerPage`. When this parameter is set, the response includes `totalHits` and `totalPages` instead of `estimatedTotalHits`. `page` and `hitsPerPage` take precedence over `offset` and `limit`.',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'hitsPerPage',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of documents per page for [pagination](https://www.meilisearch.com/docs/guides/front_end/pagination). This value determines `totalPages`; use it together with `page`. When set, the response includes `totalHits` and `totalPages`. Set to 0 to obtain the exhaustive `totalHits` count without returning any documents.',
        'schema_type' => 'integer',
      ),
      6 =>
      array (
        'name' => 'attributesToRetrieve',
        'in' => 'query',
        'required' => false,
        'description' => 'List of attributes to include in each returned document. Use `["*"]` to return all attributes; if not set, the index [displayed attributes](https://www.meilisearch.com/docs/learn/relevancy/displayed_searchable_attributes) list is used. Attributes that are not in [displayedAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-displayed-attributes-one-of-0) are omitted from the response.',
        'schema_type' => 'array',
      ),
      7 =>
      array (
        'name' => 'attributesToCrop',
        'in' => 'query',
        'required' => false,
        'description' => 'Attributes whose values should be cropped to a short excerpt. The cropped text appears in each hit\'s `_formatted` object. Length is controlled by `cropLength`, or you can override it per attribute with the `attribute:length` syntax. Use `["*"]` to crop all attributes in `attributesToRetrieve`. When possible, the crop is centered around the matching terms.',
        'schema_type' => 'array',
      ),
      8 =>
      array (
        'name' => 'cropLength',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of words to include in cropped values. This parameter only applies when `attributesToCrop` is set. Both query terms and [stop words](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-stop-words-one-of-0) count toward this length.',
        'schema_type' => 'integer',
      ),
      9 =>
      array (
        'name' => 'cropMarker',
        'in' => 'query',
        'required' => false,
        'description' => 'String used to mark crop boundaries in cropped text. If null or empty, no markers are inserted. Markers are only added where content was actually removed.',
        'schema_type' => 'string',
      ),
      10 =>
      array (
        'name' => 'attributesToHighlight',
        'in' => 'query',
        'required' => false,
        'description' => 'Attributes in which matching query terms should be highlighted. The highlighted text appears in each hit\'s `_formatted` object. Use `["*"]` to highlight in all attributes from `attributesToRetrieve`. By default, matches are wrapped in `<em>` and `</em>`; you can override this with `highlightPreTag` and `highlightPostTag`. Highlighting also applies to [synonyms](https://www.meilisearch.com/docs/learn/relevancy/synonyms) and [stop words](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-stop-words-one-of-0). Supported value types are string, number, array, and object.',
        'schema_type' => 'array',
      ),
      11 =>
      array (
        'name' => 'highlightPreTag',
        'in' => 'query',
        'required' => false,
        'description' => 'String to insert before each highlighted term. Can be any string (e.g. `<strong>`, `*`). If null or empty, nothing is inserted at the start of a match.',
        'schema_type' => 'string',
      ),
      12 =>
      array (
        'name' => 'highlightPostTag',
        'in' => 'query',
        'required' => false,
        'description' => 'String to insert after each highlighted term. Should be used together with `highlightPreTag` to avoid malformed output (e.g. unclosed HTML tags).',
        'schema_type' => 'string',
      ),
      13 =>
      array (
        'name' => 'showMatchesPosition',
        'in' => 'query',
        'required' => false,
        'description' => 'When true, each hit includes a `_matchesPosition` object with the byte offset (`start` and `length`) of each matched term. This is useful when you need custom highlighting. Note that positions are given in bytes, not characters.',
        'schema_type' => 'boolean',
      ),
      14 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'A [filter](https://www.meilisearch.com/docs/learn/filtering_and_sorting/filter_search_results) expression to narrow results. All attributes used in the expression must be in [filterableAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-filterable-attributes-one-of-0). Pass a string (e.g. `"(genres = horror OR genres = mystery) AND director = \'Jordan Peele\'"`). For [geo search](https://www.meilisearch.com/docs/learn/filtering_and_sorting/geosearch), use `_geoRadius(lat, lng, distance_in_meters)`, `_geoBoundingBox([lat,lng],[lat,lng])`, or `_geoPolygon([lat,lng], ...)` (GeoJSON only for polygon). GET route accepts a string only; the value must be URL-encoded.',
        'schema_type' => 'string',
      ),
      15 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort results by one or more attributes and their order. Use the format `["attribute:asc", "attribute:desc"]`; only attributes in [sortableAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-sortable-attributes-one-of-0) can be used. For [geo search](https://www.meilisearch.com/docs/learn/filtering_and_sorting/geosearch), use `_geoPoint(lat,lng):asc` or `:desc`; the response then includes `_geoDistance` in meters. The first attribute in the list has precedence. See [sorting search results](https://www.meilisearch.com/docs/learn/filtering_and_sorting/sort_search_results).',
        'schema_type' => 'string',
      ),
      16 =>
      array (
        'name' => 'distinct',
        'in' => 'query',
        'required' => false,
        'description' => 'Return only one document per distinct value of the given attribute (e.g. deduplicate by product_id). The attribute must be in [filterableAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-filterable-attributes-one-of-0). This overrides the index [distinctAttribute](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-distinct-attribute-one-of-0) setting for this request. See [distinct attribute](https://www.meilisearch.com/docs/learn/relevancy/distinct_attribute).',
        'schema_type' => 'string',
      ),
      17 =>
      array (
        'name' => 'facets',
        'in' => 'query',
        'required' => false,
        'description' => 'Return the count of matches per facet value for the listed attributes. The response includes `facetDistribution` and, for numeric facets, `facetStats` (min/max). Use `["*"]` to request counts for all [filterableAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-filterable-attributes-one-of-0). The number of values returned per facet is limited by the index [maxValuesPerFacet](https://www.meilisearch.com/docs/reference/api/settings/update-faceting#body-max-values-per-facet-one-of-0) setting; attributes not in filterableAttributes are ignored. More info: [faceting](https://www.meilisearch.com/docs/learn/filtering_and_sorting/search_with_facet_filters).',
        'schema_type' => 'array',
      ),
      18 =>
      array (
        'name' => 'matchingStrategy',
        'in' => 'query',
        'required' => false,
        'description' => 'How to match query terms when there are not enough results to satisfy `limit`. **`last`**: Returns documents containing all query terms first. If there are not enough such results, Meilisearch removes one query term at a time, starting from the end of the query (e.g. for "big fat cat", then "big fat", then "big"). **`all`**: Only returns documents that contain all query terms. Meilisearch does not relax the query even if fewer than `limit` documents match. **`frequency`**: Returns documents containing all query terms first. If there are not enough, removes one term at a time starting with the word that is most frequent in the dataset, giving more weight to rarer terms (e.g. in "white cotton shirt", prioritizes documents containing "white" if "shirt" is very common). Default: `last`.',
        'schema_type' => 'string',
      ),
      19 =>
      array (
        'name' => 'attributesToSearchOn',
        'in' => 'query',
        'required' => false,
        'description' => 'Restrict the search to the listed attributes only. Each attribute must be in the index [searchable attributes](https://www.meilisearch.com/docs/learn/relevancy/displayed_searchable_attributes) list. The order of attributes in this parameter does not affect relevancy.',
        'schema_type' => 'array',
      ),
      20 =>
      array (
        'name' => 'rankingScoreThreshold',
        'in' => 'query',
        'required' => false,
        'description' => 'Exclude from the results any document whose [ranking score](https://www.meilisearch.com/docs/learn/relevancy/ranking_score) is below this value (between 0.0 and 1.0). Excluded hits do not count toward `estimatedTotalHits`, `totalHits`, or facet distribution. When used together with `page` and `hitsPerPage`, this parameter may reduce performance because Meilisearch must score all matching documents.',
        'schema_type' => 'number',
      ),
      21 =>
      array (
        'name' => 'locales',
        'in' => 'query',
        'required' => false,
        'description' => 'Explicitly specify the language(s) of the query. Pass an array of [supported ISO-639 locales](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-localized-attributes-one-of-0). This overrides auto-detection; use it when auto-detection is wrong for the query or the documents. See also the [localizedAttributes](https://www.meilisearch.com/docs/reference/api/settings/list-all-settings#response-localized-attributes-one-of-0) settings and [Language](https://www.meilisearch.com/docs/learn/resources/language).',
        'schema_type' => 'array',
      ),
      22 =>
      array (
        'name' => 'hybridEmbedder',
        'in' => 'query',
        'required' => false,
        'description' => 'Name of the embedder for [hybrid search](https://www.meilisearch.com/docs/learn/ai_powered_search/getting_started_with_ai_search), which combines keyword and semantic search. Must match an embedder configured in the index settings. Required when `vector` or `hybridSemanticRatio` is set.',
        'schema_type' => 'string',
      ),
      23 =>
      array (
        'name' => 'hybridSemanticRatio',
        'in' => 'query',
        'required' => false,
        'description' => 'Balance between keyword and semantic search: 0.0 means keyword-only results, 1.0 means semantic-only. When `q` is empty and this value is greater than 0, Meilisearch performs a pure semantic search. Requires `hybridEmbedder` when set.',
        'schema_type' => 'number',
      ),
      24 =>
      array (
        'name' => 'vector',
        'in' => 'query',
        'required' => false,
        'description' => 'Custom query vector for [vector or hybrid search](https://www.meilisearch.com/docs/learn/ai_powered_search/getting_started_with_ai_search). The array length must match the dimensions of the embedder configured in the index. This parameter is mandatory when using a [user-provided embedder](https://www.meilisearch.com/docs/learn/ai_powered_search/search_with_user_provided_embeddings). When used with `hybrid`, documents are ranked by vector similarity. You can also use it to override an embedder\'s automatic vector generation.',
        'schema_type' => 'array',
      ),
      25 =>
      array (
        'name' => 'retrieveVectors',
        'in' => 'query',
        'required' => false,
        'description' => 'When true, the response includes document and query embeddings in each hit\'s `_vectors` field. The `_vectors` field must be listed in [displayedAttributes](https://www.meilisearch.com/docs/reference/api/settings/update-all-settings#body-displayed-attributes-one-of-0) for it to appear.',
        'schema_type' => 'boolean',
      ),
      26 =>
      array (
        'name' => 'personalizeUserContext',
        'in' => 'query',
        'required' => false,
        'description' => 'For [personalized search](https://www.meilisearch.com/docs/learn/personalization/making_personalized_search_queries): a string describing the user (e.g. preferences or behavior). Results are then tailored to that profile. Personalization must be [enabled](https://www.meilisearch.com/docs/reference/api/experimental-features/configure-experimental-features) (e.g. Cohere key for self-hosted instances).',
        'schema_type' => 'string',
      ),
      27 =>
      array (
        'name' => 'useNetwork',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, runs the query on the whole network (all shards covered, documents deduplicated across remotes). When `false` or omitted, the query runs locally. **Enterprise Edition only.** This feature is available in the Enterprise Edition. It also requires the `network` [experimental feature](http://localhost:3000/reference/api/experimental-features/configure-experimental-features). Values: `true` = use the whole network; `false` or omitted = local (default). When using the network, the index must exist with compatible settings on all remotes. Documents with the same id are assumed identical for deduplication.',
        'schema_type' => 'boolean',
      ),
      28 =>
      array (
        'name' => 'showRankingScore',
        'in' => 'query',
        'required' => false,
        'description' => 'When true, each document includes a `_rankingScore` between 0.0 and 1.0; a higher value means the document is more relevant. See [ranking score](https://www.meilisearch.com/docs/learn/relevancy/ranking_score). The `sort` ranking rule does not affect the value of `_rankingScore`.',
        'schema_type' => 'boolean',
      ),
      29 =>
      array (
        'name' => 'showRankingScoreDetails',
        'in' => 'query',
        'required' => false,
        'description' => 'When true, each document includes `_rankingScoreDetails`, which breaks down the score contribution of each [ranking rule](https://www.meilisearch.com/docs/learn/relevancy/ranking_rules). Useful for debugging relevancy.',
        'schema_type' => 'boolean',
      ),
      30 =>
      array (
        'name' => 'showPerformanceDetails',
        'in' => 'query',
        'required' => false,
        'description' => 'When true, the response includes a `performanceDetails` object with a timing breakdown of the query processing.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_similar_get' =>
  array (
    'slug' => 'meilisearch_similar_get',
    'class' => 'MeilisearchSimilarGet',
    'type' => 'read',
    'name' => 'Get similar documents with GET',
    'description' => 'Retrieve documents similar to a reference document identified by its id. > Useful for "more like this" or recommendations.',
    'operation_id' => 'similar_get',
    'method' => 'GET',
    'path' => '/indexes/{index_uid}/similar',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => true,
        'description' => 'The unique identifier ([primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) value) of the target document. Meilisearch will find and return documents that are semantically similar to this document based on their vector embeddings. This is a required parameter.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'embedder',
        'in' => 'query',
        'required' => true,
        'description' => 'The name of the embedder to use for finding similar documents. This must match one of the embedders configured in your index settings. The embedder determines how document similarity is calculated based on vector embeddings.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'offset',
        'in' => 'query',
        'required' => false,
        'description' => 'Number of similar documents to skip in the response. Use together with `limit` for pagination through large result sets. For example, to get similar documents 21-40, set `offset=20` and `limit=20`. Defaults to `0`.',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'limit',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of similar documents to return in a single response. Use together with `offset` for pagination. Higher values return more results but may increase response time. Defaults to `20`.',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'attributes_to_retrieve',
        'in' => 'query',
        'required' => false,
        'description' => 'Comma-separated list of document attributes to include in the response. Use `*` to retrieve all attributes. By default, all attributes listed in the `displayedAttributes` setting are returned. Example: `title,description,price`.',
        'schema_type' => 'array',
      ),
      6 =>
      array (
        'name' => 'retrieve_vectors',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes the vector embeddings for each returned document. Useful for debugging or when you need to inspect the vector data. Note that this can significantly increase response size. Defaults to `false`.',
        'schema_type' => 'boolean',
      ),
      7 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter expression to narrow down which documents can be returned as similar. Uses the same syntax as search filters. Only documents matching this filter will be considered when finding similar documents. Example: `genres = action AND year > 2000`.',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'show_ranking_score',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes a global `_rankingScore` field in each document showing how similar it is to the target document. The score is a value between 0 and 1, where higher values indicate greater similarity. Defaults to `false`.',
        'schema_type' => 'boolean',
      ),
      9 =>
      array (
        'name' => 'show_ranking_score_details',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes a detailed `_rankingScoreDetails` object in each document breaking down how the similarity score was calculated. Useful for debugging and understanding why certain documents are considered more similar. Defaults to `false`.',
        'schema_type' => 'boolean',
      ),
      10 =>
      array (
        'name' => 'show_performance_details',
        'in' => 'query',
        'required' => false,
        'description' => 'When `true`, includes a `_performanceDetails` object showing the performance details of the search.',
        'schema_type' => 'boolean',
      ),
      11 =>
      array (
        'name' => 'ranking_score_threshold',
        'in' => 'query',
        'required' => false,
        'description' => 'Minimum ranking score threshold (between 0.0 and 1.0) that documents must meet to be included in results. Documents with a similarity score below this threshold will be excluded. Useful for ensuring only highly similar documents are returned.',
        'schema_type' => 'number',
      ),
    ),
    'request_body' => NULL,
  ),
  'meilisearch_similar_post' =>
  array (
    'slug' => 'meilisearch_similar_post',
    'class' => 'MeilisearchSimilarPost',
    'type' => 'write',
    'name' => 'Get similar documents with POST',
    'description' => 'Retrieve documents similar to a reference document identified by its id. > Useful for "more like this" or recommendations.',
    'operation_id' => 'similar_post',
    'method' => 'POST',
    'path' => '/indexes/{index_uid}/similar',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_swap_indexes' =>
  array (
    'slug' => 'meilisearch_swap_indexes',
    'class' => 'MeilisearchSwapIndexes',
    'type' => 'write',
    'name' => 'Swap indexes',
    'description' => 'Swap the documents, settings, and task history of two or more indexes. Indexes are swapped in pairs; a single request can include multiple pairs. The operation is atomic: either all swaps succeed or none do. In the task history, every mention of one index uid is replaced by the other and vice versa. Enqueued tasks are left unmodified.',
    'operation_id' => 'swap_indexes',
    'method' => 'POST',
    'path' => '/swap-indexes',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_update_all' =>
  array (
    'slug' => 'meilisearch_update_all',
    'class' => 'MeilisearchUpdateAll',
    'type' => 'write',
    'name' => 'Update all settings',
    'description' => 'Updates one or more settings for the index. Only the fields sent in the body are changed. Pass null for a setting to reset it to its default. If the index does not exist, it is created. See also: [Configuring index settings on the Cloud](https://www.meilisearch.com/docs/learn/configuration/configuring_index_settings).',
    'operation_id' => 'update_all',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}/settings',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_update_documents' =>
  array (
    'slug' => 'meilisearch_update_documents',
    'class' => 'MeilisearchUpdateDocuments',
    'type' => 'write',
    'name' => 'Add or update documents',
    'description' => 'Add a list of documents or update them if they already exist. If you send an already existing document (same id) the old document will be only partially updated according to the fields of the new document. Thus, any fields not present in the new document are kept and remained unchanged. If the provided index does not exist, it will be created. To completely overwrite a document, see [add or replace documents route](/reference/api/documents/add-or-replace-documents). > Use the reserved `_geo` object to add geo coordinates to a document. > `_geo` is an object made of `lat` and `lng` field.',
    'operation_id' => 'update_documents',
    'method' => 'PUT',
    'path' => '/indexes/{index_uid}/documents',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'primaryKey',
        'in' => 'query',
        'required' => false,
        'description' => 'The [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) field for uniquely identifying each document. This parameter is optional and can only be set the first time documents are added to an index. Subsequent attempts to specify it will be ignored if the primary key has already been set.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'csvDelimiter',
        'in' => 'query',
        'required' => false,
        'description' => 'Customize the csv delimiter when importing CSV documents.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'customMetadata',
        'in' => 'query',
        'required' => false,
        'description' => 'A string that can be used to identify and filter tasks. This metadata is stored with the task and returned in task responses. Useful for tracking tasks from external systems or associating tasks with specific operations in your application.',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'skipCreation',
        'in' => 'query',
        'required' => false,
        'description' => 'When set to `true`, only updates existing documents and skips creating new ones. Documents that don\'t already exist in the index will be ignored. This is useful for partial updates where you only want to modify existing records without adding new ones.',
        'schema_type' => 'boolean',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_update_index' =>
  array (
    'slug' => 'meilisearch_update_index',
    'class' => 'MeilisearchUpdateIndex',
    'type' => 'write',
    'name' => 'Update index',
    'description' => 'Update the [primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) or uid of an index. Returns an error if the index does not exist or if it already contains documents ([primary key](https://www.meilisearch.com/docs/learn/getting_started/primary_key) cannot be changed in that case).',
    'operation_id' => 'update_index',
    'method' => 'PATCH',
    'path' => '/indexes/{index_uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'index_uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the index.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_update_or_create_rule' =>
  array (
    'slug' => 'meilisearch_update_or_create_rule',
    'class' => 'MeilisearchUpdateOrCreateRule',
    'type' => 'write',
    'name' => 'Create or update a search rule',
    'description' => 'Partially update a search rule by replacing the provided fields. If the rule doesn\'t exist, it will be created.',
    'operation_id' => 'update_or_create_rule',
    'method' => 'PATCH',
    'path' => '/dynamic-search-rules/{uid}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'uid',
        'in' => 'path',
        'required' => true,
        'description' => 'Unique identifier of the search rule.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
  'meilisearch_update_stderr_target' =>
  array (
    'slug' => 'meilisearch_update_stderr_target',
    'class' => 'MeilisearchUpdateStderrTarget',
    'type' => 'write',
    'name' => 'Update target of the console logs',
    'description' => 'Configure at runtime the level of the console logs written to stderr (e.g. debug, info, warn, error).',
    'operation_id' => 'update_stderr_target',
    'method' => 'POST',
    'path' => '/logs/stderr',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => '',
    ),
  ),
);
    }
}
