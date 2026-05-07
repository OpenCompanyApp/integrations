<?php

namespace OpenCompany\Integrations\Beehiiv;

/**
 * Official beehiiv OpenAPI operation metadata.
 *
 * Source: https://files.buildwithfern.com/https%3A//beehiiv.docs.buildwithfern.com/ce117ceb8170960e1daef3750597e88705645d547d7ee2fee49c5bebfd5c6b6d/assets/beehiiv-API-Specification.yaml.
 */
class BeehiivOperations
{
    /**
     * Return all supported beehiiv API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'advertisementOpportunities_index',
    'slug' => 'beehiiv_advertisement_opportunities_index',
    'class' => 'BeehiivAdvertisementOpportunitiesIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/advertisement_opportunities',
    'name' => 'Get advertisement opportunities OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `advertisementOpportunities_index`.

Endpoint: GET /publications/{publicationId}/advertisement_opportunities.',
    'type' => 'read',
    'tag' => 'AdvertisementOpportunities',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
    ],
  ],
  1 =>
  [
    'operation' => 'authors_index',
    'slug' => 'beehiiv_authors_index',
    'class' => 'BeehiivAuthorsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/authors',
    'name' => 'List authors',
    'description' => 'Execute official beehiiv API operation `authors_index`.

Endpoint: GET /publications/{publicationId}/authors.',
    'type' => 'read',
    'tag' => 'Authors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      3 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter authors by full name or first name (case-insensitive].',
      ],
    ],
  ],
  2 =>
  [
    'operation' => 'authors_show',
    'slug' => 'beehiiv_authors_show',
    'class' => 'BeehiivAuthorsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/authors/{authorId}',
    'name' => 'Get author',
    'description' => 'Execute official beehiiv API operation `authors_show`.

Endpoint: GET /publications/{publicationId}/authors/{authorId}.',
    'type' => 'read',
    'tag' => 'Authors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'authorId',
        'param' => 'author_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The author identifier. This accepts author UUID, full name, or first name.',
      ],
    ],
  ],
  3 =>
  [
    'operation' => 'automationJourneys_create',
    'slug' => 'beehiiv_automation_journeys_create',
    'class' => 'BeehiivAutomationJourneysCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/automations/{automationId}/journeys',
    'name' => 'Add subscription to an automation OAuth Scope: automations:write',
    'description' => 'Execute official beehiiv API operation `automationJourneys_create`.

Endpoint: POST /publications/{publicationId}/automations/{automationId}/journeys.',
    'type' => 'write',
    'tag' => 'AutomationJourneys',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the automation object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  4 =>
  [
    'operation' => 'automationJourneys_index',
    'slug' => 'beehiiv_automation_journeys_index',
    'class' => 'BeehiivAutomationJourneysIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/automations/{automationId}/journeys',
    'name' => 'List automation journeys OAuth Scope: automations:read',
    'description' => 'Execute official beehiiv API operation `automationJourneys_index`.

Endpoint: GET /publications/{publicationId}/automations/{automationId}/journeys.',
    'type' => 'read',
    'tag' => 'AutomationJourneys',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the automation object',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the automation journey\'s status.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].',
      ],
    ],
  ],
  5 =>
  [
    'operation' => 'automationJourneys_show',
    'slug' => 'beehiiv_automation_journeys_show',
    'class' => 'BeehiivAutomationJourneysShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/automations/{automationId}/journeys/{automationJourneyId}',
    'name' => 'Get automation journey OAuth Scope: automations:read',
    'description' => 'Execute official beehiiv API operation `automationJourneys_show`.

Endpoint: GET /publications/{publicationId}/automations/{automationId}/journeys/{automationJourneyId}.',
    'type' => 'read',
    'tag' => 'AutomationJourneys',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the automation object',
      ],
      2 =>
      [
        'name' => 'automationJourneyId',
        'param' => 'automation_journey_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed automation journey id',
      ],
    ],
  ],
  6 =>
  [
    'operation' => 'automations_index',
    'slug' => 'beehiiv_automations_index',
    'class' => 'BeehiivAutomationsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/automations',
    'name' => 'List automations OAuth Scope: automations:read',
    'description' => 'Execute official beehiiv API operation `automations_index`.

Endpoint: GET /publications/{publicationId}/automations.',
    'type' => 'read',
    'tag' => 'Automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
    ],
  ],
  7 =>
  [
    'operation' => 'automations_listEmails',
    'slug' => 'beehiiv_automations_list_emails',
    'class' => 'BeehiivAutomationsListEmails',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/automations/{automationId}/emails',
    'name' => 'List automation emails',
    'description' => 'Execute official beehiiv API operation `automations_listEmails`.

Endpoint: GET /publications/{publicationId}/automations/{automationId}/emails.',
    'type' => 'read',
    'tag' => 'Automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the automation object',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results. Obtain it from the `next_cursor` field of a previous response.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Deprecated**: Use `cursor` instead. Pagination returns the results in pages. Limited to 100 pages maximum.',
      ],
    ],
  ],
  8 =>
  [
    'operation' => 'automations_show',
    'slug' => 'beehiiv_automations_show',
    'class' => 'BeehiivAutomationsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/automations/{automationId}',
    'name' => 'Get automation OAuth Scope: automations:read',
    'description' => 'Execute official beehiiv API operation `automations_show`.

Endpoint: GET /publications/{publicationId}/automations/{automationId}.',
    'type' => 'read',
    'tag' => 'Automations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'automationId',
        'param' => 'automation_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the automation object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.',
      ],
    ],
  ],
  9 =>
  [
    'operation' => 'bulkSubscriptionUpdates_index',
    'slug' => 'beehiiv_bulk_subscription_updates_index',
    'class' => 'BeehiivBulkSubscriptionUpdatesIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/bulk_subscription_updates',
    'name' => 'List subscription updates OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_index`.

Endpoint: GET /publications/{publicationId}/bulk_subscription_updates.',
    'type' => 'read',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
    ],
  ],
  10 =>
  [
    'operation' => 'bulkSubscriptionUpdates_patch',
    'slug' => 'beehiiv_bulk_subscription_updates_patch',
    'class' => 'BeehiivBulkSubscriptionUpdatesPatch',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/subscriptions/bulk_actions',
    'name' => 'Update subscriptions OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_patch`.

Endpoint: PATCH /publications/{publicationId}/subscriptions/bulk_actions.',
    'type' => 'write',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  11 =>
  [
    'operation' => 'bulkSubscriptionUpdates_patch-status',
    'slug' => 'beehiiv_bulk_subscription_updates_patch_status',
    'class' => 'BeehiivBulkSubscriptionUpdatesPatchStatus',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/subscriptions',
    'name' => 'Update subscriptions\' status OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_patch-status`.

Endpoint: PATCH /publications/{publicationId}/subscriptions.',
    'type' => 'write',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  12 =>
  [
    'operation' => 'bulkSubscriptionUpdates_put',
    'slug' => 'beehiiv_bulk_subscription_updates_put',
    'class' => 'BeehiivBulkSubscriptionUpdatesPut',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/subscriptions/bulk_actions',
    'name' => 'Update subscriptions OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_put`.

Endpoint: PUT /publications/{publicationId}/subscriptions/bulk_actions.',
    'type' => 'write',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  13 =>
  [
    'operation' => 'bulkSubscriptionUpdates_put-status',
    'slug' => 'beehiiv_bulk_subscription_updates_put_status',
    'class' => 'BeehiivBulkSubscriptionUpdatesPutStatus',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/subscriptions',
    'name' => 'Update subscriptions\' status OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_put-status`.

Endpoint: PUT /publications/{publicationId}/subscriptions.',
    'type' => 'write',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  14 =>
  [
    'operation' => 'bulkSubscriptionUpdates_show',
    'slug' => 'beehiiv_bulk_subscription_updates_show',
    'class' => 'BeehiivBulkSubscriptionUpdatesShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/bulk_subscription_updates/{id}',
    'name' => 'Get subscription update OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptionUpdates_show`.

Endpoint: GET /publications/{publicationId}/bulk_subscription_updates/{id}.',
    'type' => 'read',
    'tag' => 'BulkSubscriptionUpdates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Subscription Update object',
      ],
    ],
  ],
  15 =>
  [
    'operation' => 'bulkSubscriptions_create',
    'slug' => 'beehiiv_bulk_subscriptions_create',
    'class' => 'BeehiivBulkSubscriptionsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/bulk_subscriptions',
    'name' => 'Bulk create subscription OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `bulkSubscriptions_create`.

Endpoint: POST /publications/{publicationId}/bulk_subscriptions.',
    'type' => 'write',
    'tag' => 'BulkSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  16 =>
  [
    'operation' => 'conditionSets_index',
    'slug' => 'beehiiv_condition_sets_index',
    'class' => 'BeehiivConditionSetsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/condition_sets',
    'name' => 'List condition sets OAuth Scope: condition_sets:read',
    'description' => 'Execute official beehiiv API operation `conditionSets_index`.

Endpoint: GET /publications/{publicationId}/condition_sets.',
    'type' => 'read',
    'tag' => 'ConditionSets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results. When provided, pagination will use cursor-based method which is more efficient and consistent than offset-based pagination.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Offset-based pagination (deprecated]**: Page number for offset-based pagination. Please migrate to cursor-based pagination using the `cursor` parameter. If not specified, results 1-10 from page 1 will be returned.',
      ],
      4 =>
      [
        'name' => 'purpose',
        'param' => 'purpose',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter condition sets by purpose. When not specified, all active condition sets are returned.',
      ],
    ],
  ],
  17 =>
  [
    'operation' => 'conditionSets_show',
    'slug' => 'beehiiv_condition_sets_show',
    'class' => 'BeehiivConditionSetsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/condition_sets/{conditionSetId}',
    'name' => 'Get condition set OAuth Scope: condition_sets:read',
    'description' => 'Execute official beehiiv API operation `conditionSets_show`.

Endpoint: GET /publications/{publicationId}/condition_sets/{conditionSetId}.',
    'type' => 'read',
    'tag' => 'ConditionSets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'conditionSetId',
        'param' => 'condition_set_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The UUID of the condition set object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Calculates and returns the active subscriber count for this condition set synchronously.',
      ],
    ],
  ],
  18 =>
  [
    'operation' => 'customFields_create',
    'slug' => 'beehiiv_custom_fields_create',
    'class' => 'BeehiivCustomFieldsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/custom_fields',
    'name' => 'Create custom field OAuth Scope: custom_fields:write',
    'description' => 'Execute official beehiiv API operation `customFields_create`.

Endpoint: POST /publications/{publicationId}/custom_fields.',
    'type' => 'write',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  19 =>
  [
    'operation' => 'customFields_delete',
    'slug' => 'beehiiv_custom_fields_delete',
    'class' => 'BeehiivCustomFieldsDelete',
    'method' => 'DELETE',
    'path' => '/publications/{publicationId}/custom_fields/{id}',
    'name' => 'Delete custom field OAuth Scope: custom_fields:write',
    'description' => 'Execute official beehiiv API operation `customFields_delete`.

Endpoint: DELETE /publications/{publicationId}/custom_fields/{id}.',
    'type' => 'write',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Custom Fields object',
      ],
    ],
  ],
  20 =>
  [
    'operation' => 'customFields_index',
    'slug' => 'beehiiv_custom_fields_index',
    'class' => 'BeehiivCustomFieldsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/custom_fields',
    'name' => 'List custom fields OAuth Scope: custom_fields:read',
    'description' => 'Execute official beehiiv API operation `customFields_index`.

Endpoint: GET /publications/{publicationId}/custom_fields.',
    'type' => 'read',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
    ],
  ],
  21 =>
  [
    'operation' => 'customFields_patch',
    'slug' => 'beehiiv_custom_fields_patch',
    'class' => 'BeehiivCustomFieldsPatch',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/custom_fields/{id}',
    'name' => 'Update custom field OAuth Scope: custom_fields:write',
    'description' => 'Execute official beehiiv API operation `customFields_patch`.

Endpoint: PATCH /publications/{publicationId}/custom_fields/{id}.',
    'type' => 'write',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Custom Fields object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  22 =>
  [
    'operation' => 'customFields_put',
    'slug' => 'beehiiv_custom_fields_put',
    'class' => 'BeehiivCustomFieldsPut',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/custom_fields/{id}',
    'name' => 'Update custom field OAuth Scope: custom_fields:write',
    'description' => 'Execute official beehiiv API operation `customFields_put`.

Endpoint: PUT /publications/{publicationId}/custom_fields/{id}.',
    'type' => 'write',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Custom Fields object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  23 =>
  [
    'operation' => 'customFields_show',
    'slug' => 'beehiiv_custom_fields_show',
    'class' => 'BeehiivCustomFieldsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/custom_fields/{id}',
    'name' => 'Get custom field OAuth Scope: custom_fields:read',
    'description' => 'Execute official beehiiv API operation `customFields_show`.

Endpoint: GET /publications/{publicationId}/custom_fields/{id}.',
    'type' => 'read',
    'tag' => 'CustomFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Custom Fields object',
      ],
    ],
  ],
  24 =>
  [
    'operation' => 'dataDeletion_create',
    'slug' => 'beehiiv_data_deletion_create',
    'class' => 'BeehiivDataDeletionCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/data_privacy/deletion_requests',
    'name' => 'Create data deletion request OAuth Scope: data_deletion:write',
    'description' => 'Execute official beehiiv API operation `dataDeletion_create`.

Endpoint: POST /publications/{publicationId}/data_privacy/deletion_requests.',
    'type' => 'write',
    'tag' => 'DataDeletion',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  25 =>
  [
    'operation' => 'dataDeletion_index',
    'slug' => 'beehiiv_data_deletion_index',
    'class' => 'BeehiivDataDeletionIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/data_privacy/deletion_requests',
    'name' => 'List data deletion requests OAuth Scope: data_deletion:read',
    'description' => 'Execute official beehiiv API operation `dataDeletion_index`.

Endpoint: GET /publications/{publicationId}/data_privacy/deletion_requests.',
    'type' => 'read',
    'tag' => 'DataDeletion',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
    ],
  ],
  26 =>
  [
    'operation' => 'dataDeletion_show',
    'slug' => 'beehiiv_data_deletion_show',
    'class' => 'BeehiivDataDeletionShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/data_privacy/deletion_requests/{id}',
    'name' => 'Get data deletion request OAuth Scope: data_deletion:read',
    'description' => 'Execute official beehiiv API operation `dataDeletion_show`.

Endpoint: GET /publications/{publicationId}/data_privacy/deletion_requests/{id}.',
    'type' => 'read',
    'tag' => 'DataDeletion',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the data deletion request',
      ],
    ],
  ],
  27 =>
  [
    'operation' => 'emailBlasts_index',
    'slug' => 'beehiiv_email_blasts_index',
    'class' => 'BeehiivEmailBlastsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/email_blasts',
    'name' => 'List email blasts OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `emailBlasts_index`.

Endpoint: GET /publications/{publicationId}/email_blasts.',
    'type' => 'read',
    'tag' => 'EmailBlasts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the status of the email blast. Defaults to active.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10]. If not specified, results 1-10 from page 1 will be returned.',
      ],
      5 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created.',
      ],
      6 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to desc.',
      ],
    ],
  ],
  28 =>
  [
    'operation' => 'emailBlasts_show',
    'slug' => 'beehiiv_email_blasts_show',
    'class' => 'BeehiivEmailBlastsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/email_blasts/{emailBlastId}',
    'name' => 'Get email blast OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `emailBlasts_show`.

Endpoint: GET /publications/{publicationId}/email_blasts/{emailBlastId}.',
    'type' => 'read',
    'tag' => 'EmailBlasts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'emailBlastId',
        'param' => 'email_blast_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the email blast object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.',
      ],
    ],
  ],
  29 =>
  [
    'operation' => 'engagements_index',
    'slug' => 'beehiiv_engagements_index',
    'class' => 'BeehiivEngagementsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/engagements',
    'name' => 'Get publication engagements OAuth Scope: publications:read',
    'description' => 'Execute official beehiiv API operation `engagements_index`.

Endpoint: GET /publications/{publicationId}/engagements.',
    'type' => 'read',
    'tag' => 'Engagements',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Beehiiv parameter publicationId.',
      ],
      1 =>
      [
        'name' => 'start_date',
        'param' => 'start_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The starting date for the engagement metrics in `YYYY-MM-DD` format. Defaults to 1 day ago if not provided.',
      ],
      2 =>
      [
        'name' => 'number_of_days',
        'param' => 'number_of_days',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The number of days to return engagement metrics for, starting from `start_date`. Must be between 1 and 31. Defaults to `1` if not provided.',
      ],
      3 =>
      [
        'name' => 'granularity',
        'param' => 'granularity',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The granularity at which to report the engagement metrics. Defaults to `day` if not provided.',
      ],
      4 =>
      [
        'name' => 'email_type',
        'param' => 'email_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter engagement metrics by email type. If omitted, all email engagement is included. `post`: Only post emails. `message`: Only automated and system-generated emails.',
      ],
      5 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to `asc`. `asc`: Oldest to newest `desc`: Newest to oldest',
      ],
    ],
  ],
  30 =>
  [
    'operation' => 'newsletterListSubscriptions_create',
    'slug' => 'beehiiv_newsletter_list_subscriptions_create',
    'class' => 'BeehiivNewsletterListSubscriptionsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions',
    'name' => 'Create newsletter list subscription Beta OAuth Scope: newsletter_lists:write',
    'description' => 'Execute official beehiiv API operation `newsletterListSubscriptions_create`.

Endpoint: POST /publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions.',
    'type' => 'write',
    'tag' => 'NewsletterListSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  31 =>
  [
    'operation' => 'newsletterListSubscriptions_index',
    'slug' => 'beehiiv_newsletter_list_subscriptions_index',
    'class' => 'BeehiivNewsletterListSubscriptionsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions',
    'name' => 'List newsletter list subscriptions Beta OAuth Scope: newsletter_lists:read',
    'description' => 'Execute official beehiiv API operation `newsletterListSubscriptions_index`.

Endpoint: GET /publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions.',
    'type' => 'read',
    'tag' => 'NewsletterListSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results. When provided, pagination will use cursor-based method which is more efficient and consistent than offset-based pagination.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Offset-based pagination (deprecated]**: Page number for offset-based pagination. Please migrate to cursor-based pagination using the `cursor` parameter. If not specified, results 1-10 from page 1 will be returned.',
      ],
      5 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
    ],
  ],
  32 =>
  [
    'operation' => 'newsletterListSubscriptions_show',
    'slug' => 'beehiiv_newsletter_list_subscriptions_show',
    'class' => 'BeehiivNewsletterListSubscriptionsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}',
    'name' => 'Get newsletter list subscription Beta OAuth Scope: newsletter_lists:read',
    'description' => 'Execute official beehiiv API operation `newsletterListSubscriptions_show`.

Endpoint: GET /publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}.',
    'type' => 'read',
    'tag' => 'NewsletterListSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
      2 =>
      [
        'name' => 'newsletterListSubscriptionId',
        'param' => 'newsletter_list_subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list subscription object',
      ],
    ],
  ],
  33 =>
  [
    'operation' => 'newsletterListSubscriptions_update',
    'slug' => 'beehiiv_newsletter_list_subscriptions_update',
    'class' => 'BeehiivNewsletterListSubscriptionsUpdate',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}',
    'name' => 'Update newsletter list subscription Beta OAuth Scope: newsletter_lists:write',
    'description' => 'Execute official beehiiv API operation `newsletterListSubscriptions_update`.

Endpoint: PATCH /publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}.',
    'type' => 'write',
    'tag' => 'NewsletterListSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
      2 =>
      [
        'name' => 'newsletterListSubscriptionId',
        'param' => 'newsletter_list_subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list subscription object',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  34 =>
  [
    'operation' => 'newsletterListSubscriptions_update_by_subscription_id',
    'slug' => 'beehiiv_newsletter_list_subscriptions_update_by_subscription_id',
    'class' => 'BeehiivNewsletterListSubscriptionsUpdateBySubscriptionId',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/by_subscription_id/{subscriptionId}',
    'name' => 'Update newsletter list subscription by subscription ID Beta OAuth Scope: newsletter_lists:write',
    'description' => 'Execute official beehiiv API operation `newsletterListSubscriptions_update_by_subscription_id`.

Endpoint: PATCH /publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/by_subscription_id/{subscriptionId}.',
    'type' => 'write',
    'tag' => 'NewsletterListSubscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
      2 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  35 =>
  [
    'operation' => 'newsletterLists_index',
    'slug' => 'beehiiv_newsletter_lists_index',
    'class' => 'BeehiivNewsletterListsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/newsletter_lists',
    'name' => 'List newsletter lists Beta OAuth Scope: newsletter_lists:read',
    'description' => 'Execute official beehiiv API operation `newsletterLists_index`.

Endpoint: GET /publications/{publicationId}/newsletter_lists.',
    'type' => 'read',
    'tag' => 'NewsletterLists',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      3 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
    ],
  ],
  36 =>
  [
    'operation' => 'newsletterLists_show',
    'slug' => 'beehiiv_newsletter_lists_show',
    'class' => 'BeehiivNewsletterListsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/newsletter_lists/{newsletterListId}',
    'name' => 'Get newsletter list Beta OAuth Scope: newsletter_lists:read',
    'description' => 'Execute official beehiiv API operation `newsletterLists_show`.

Endpoint: GET /publications/{publicationId}/newsletter_lists/{newsletterListId}.',
    'type' => 'read',
    'tag' => 'NewsletterLists',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'newsletterListId',
        'param' => 'newsletter_list_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the newsletter list object',
      ],
    ],
  ],
  37 =>
  [
    'operation' => 'oauthUsers_identify',
    'slug' => 'beehiiv_oauth_users_identify',
    'class' => 'BeehiivOauthUsersIdentify',
    'method' => 'GET',
    'path' => '/users/identify',
    'name' => 'Identify user OAuth Scope: identify:read',
    'description' => 'Execute official beehiiv API operation `oauthUsers_identify`.

Endpoint: GET /users/identify.',
    'type' => 'read',
    'tag' => 'OauthUsers',
    'parameters' =>
    [
    ],
  ],
  38 =>
  [
    'operation' => 'polls_index',
    'slug' => 'beehiiv_polls_index',
    'class' => 'BeehiivPollsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/polls',
    'name' => 'List polls OAuth Scope: polls:read',
    'description' => 'Execute official beehiiv API operation `polls_index`.

Endpoint: GET /publications/{publicationId}/polls.',
    'type' => 'read',
    'tag' => 'Polls',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results. When provided, pagination will use cursor-based method which is more efficient and consistent than offset-based pagination.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Offset-based pagination (deprecated]**: Page number for offset-based pagination. Please migrate to cursor-based pagination using the `cursor` parameter. If not specified, results 1-10 from page 1 will be returned.',
      ],
      4 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created. `created` - The time the poll was created. `name` - The name of the poll.',
      ],
      5 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc. `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      6 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Returns aggregate vote counts per choice and total completions. `poll_responses` - Returns up to 10 most recent subscriber responses. Use /polls/{pollId}/responses for paginated access to all responses. `trivia_answer` - Returns the correct answer for trivia-type polls.',
      ],
      7 =>
      [
        'name' => 'post_id',
        'param' => 'post_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter to only return polls that were embedded in the specified post. Accepts a prefixed post ID (e.g. `post_abc123`].',
      ],
    ],
  ],
  39 =>
  [
    'operation' => 'polls_list_responses',
    'slug' => 'beehiiv_polls_list_responses',
    'class' => 'BeehiivPollsListResponses',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/polls/{pollId}/responses',
    'name' => 'List poll responses OAuth Scope: polls:read',
    'description' => 'Execute official beehiiv API operation `polls_list_responses`.

Endpoint: GET /publications/{publicationId}/polls/{pollId}/responses.',
    'type' => 'read',
    'tag' => 'Polls',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'pollId',
        'param' => 'poll_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the poll object',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Offset-based pagination (deprecated]**: Page number for offset-based pagination.',
      ],
      5 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created.',
      ],
      6 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc. `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      7 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `post` - Returns the post title and publication date for the post where each response was collected.',
      ],
      8 =>
      [
        'name' => 'post_id',
        'param' => 'post_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter to only return responses collected via the specified post. Accepts a prefixed post ID (e.g. `post_abc123`].',
      ],
    ],
  ],
  40 =>
  [
    'operation' => 'polls_show',
    'slug' => 'beehiiv_polls_show',
    'class' => 'BeehiivPollsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/polls/{pollId}',
    'name' => 'Get poll OAuth Scope: polls:read',
    'description' => 'Execute official beehiiv API operation `polls_show`.

Endpoint: GET /publications/{publicationId}/polls/{pollId}.',
    'type' => 'read',
    'tag' => 'Polls',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'pollId',
        'param' => 'poll_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the poll object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Returns aggregate vote counts per choice and total completions. `poll_responses` - Returns up to 10 most recent subscriber responses. Use /polls/{pollId}/responses for paginated access to all responses. `trivia_answer` - Returns the correct answer for trivia-type polls.',
      ],
    ],
  ],
  41 =>
  [
    'operation' => 'postTemplates_index',
    'slug' => 'beehiiv_post_templates_index',
    'class' => 'BeehiivPostTemplatesIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/post_templates',
    'name' => 'Get post templates',
    'description' => 'Execute official beehiiv API operation `postTemplates_index`.

Endpoint: GET /publications/{publicationId}/post_templates.',
    'type' => 'read',
    'tag' => 'PostTemplates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      3 =>
      [
        'name' => 'order',
        'param' => 'order',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction of the request. Defaults to `asc`.',
      ],
      4 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field to order by. Defaults to `created`.',
      ],
    ],
  ],
  42 =>
  [
    'operation' => 'posts_aggregate_stats',
    'slug' => 'beehiiv_posts_aggregate_stats',
    'class' => 'BeehiivPostsAggregateStats',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/posts/aggregate_stats',
    'name' => 'Get aggregate stats OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `posts_aggregate_stats`.

Endpoint: GET /publications/{publicationId}/posts/aggregate_stats.',
    'type' => 'read',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'audience',
        'param' => 'audience',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by audience',
      ],
      2 =>
      [
        'name' => 'platform',
        'param' => 'platform',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by platform.`web` - Posts only published to web.`email` - Posts only published to email.`both` - Posts published to email and web.`all` - Does not restrict results by platform.',
      ],
      3 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the status of the post.`draft` - not been scheduled.`confirmed` - The post will be active after the `scheduled_at`.`archived` - The post is no longer active.`all` - Does not restrict results by status.',
      ],
      4 =>
      [
        'name' => 'content_tags[]',
        'param' => 'content_tags',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by content_tags. Adding a content tag will return any post with that content tag associated to it.Example: Filtering for `content_tags: ["sales","closing"]` will return results of posts that have *either* sales or closing content_tags.',
      ],
      5 =>
      [
        'name' => 'authors[]',
        'param' => 'authors',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by their authors. Adding an author name will return any post with that author associated to it (case-insensitive].Example: Filtering for `authors: ["John Doe","Jane Smith"]` will return results of posts that have *either* John Doe or Jane Smith as authors.',
      ],
      6 =>
      [
        'name' => 'hidden_from_feed',
        'param' => 'hidden_from_feed',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the `hidden_from_feed` attribute of the post.`all` - Does not restrict results by `hidden_from_feed`.`true` - Only return posts hidden from the feed.`false` - Only return posts that are visible on the feed.',
      ],
    ],
  ],
  43 =>
  [
    'operation' => 'posts_create',
    'slug' => 'beehiiv_posts_create',
    'class' => 'BeehiivPostsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/posts',
    'name' => 'Create post OAuth Scope: posts:write',
    'description' => 'Execute official beehiiv API operation `posts_create`.

Endpoint: POST /publications/{publicationId}/posts.',
    'type' => 'write',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  44 =>
  [
    'operation' => 'posts_delete',
    'slug' => 'beehiiv_posts_delete',
    'class' => 'BeehiivPostsDelete',
    'method' => 'DELETE',
    'path' => '/publications/{publicationId}/posts/{postId}',
    'name' => 'Delete post OAuth Scope: posts:write',
    'description' => 'Execute official beehiiv API operation `posts_delete`.

Endpoint: DELETE /publications/{publicationId}/posts/{postId}.',
    'type' => 'write',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'postId',
        'param' => 'post_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the post object',
      ],
    ],
  ],
  45 =>
  [
    'operation' => 'posts_index',
    'slug' => 'beehiiv_posts_index',
    'class' => 'BeehiivPostsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/posts',
    'name' => 'List posts OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `posts_index`.

Endpoint: GET /publications/{publicationId}/posts.',
    'type' => 'read',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the results by adding additional information. `stats` - Adds statistics about the post(s]. `free_web_content` - Adds the web HTML rendered to a free reader. `free_email_content` - Adds the email HTML rendered to a free reader. `free_rss_content` - Adds the RSS feed HTML. `premium_web_content` - Adds the web HTML rendered to a premium reader. `premium_email_content` - Adds the email HTML rendered to a premium reader.',
      ],
      2 =>
      [
        'name' => 'audience',
        'param' => 'audience',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by audience',
      ],
      3 =>
      [
        'name' => 'platform',
        'param' => 'platform',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by platform.`web` - Posts only published to web.`email` - Posts only published to email.`both` - Posts published to email and web.`all` - Does not restrict results by platform.',
      ],
      4 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the status of the post.`draft` - not been scheduled.`confirmed` - The post will be active after the `scheduled_at`.`archived` - The post is no longer active.`all` - Does not restrict results by status.',
      ],
      5 =>
      [
        'name' => 'content_tags[]',
        'param' => 'content_tags',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by content_tags. Adding a content tag will return any post with that content tag associated to it.Example: Filtering for `content_tags: ["sales","closing"]` will return results of posts that have *either* `sales` or `closing` content_tags.',
      ],
      6 =>
      [
        'name' => 'slugs[]',
        'param' => 'slugs',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by their slugs. Adding a slug will return any post with that exact slug associated to it.Example: Filtering for `slugs: ["my-first-post","another-post"]` will return results of posts that have *either* `my-first-post` or `another-post` as their slug.',
      ],
      7 =>
      [
        'name' => 'authors[]',
        'param' => 'authors',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by their authors. Adding an author name will return any post with that author associated to it (case-insensitive].Example: Filtering for `authors: ["John Doe","Jane Smith"]` will return results of posts that have *either* John Doe or Jane Smith as authors.',
      ],
      8 =>
      [
        'name' => 'premium_tiers',
        'param' => 'premium_tiers',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter posts by audience based on premium tiers. This takes in an array of Display Names of the premium tiers. It will also scope any expanded content output to the specified premium tiers. Note: This is case insensitive.',
      ],
      9 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      10 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      11 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created `created` - The time in which the post was first created. `publish_date` - The time the post was set to be published. `displayed_date` - The time displayed in place of the `publish_date`. If no `displayed_date` was set, it will default to the `publish_date`',
      ],
      12 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      13 =>
      [
        'name' => 'hidden_from_feed',
        'param' => 'hidden_from_feed',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the `hidden_from_feed` attribute of the post.`all` - Does not restrict results by `hidden_from_feed`.`true` - Only return posts hidden from the feed.`false` - Only return posts that are visible on the feed.',
      ],
    ],
  ],
  46 =>
  [
    'operation' => 'posts_show',
    'slug' => 'beehiiv_posts_show',
    'class' => 'BeehiivPostsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/posts/{postId}',
    'name' => 'Get post OAuth Scope: posts:read',
    'description' => 'Execute official beehiiv API operation `posts_show`.

Endpoint: GET /publications/{publicationId}/posts/{postId}.',
    'type' => 'read',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'postId',
        'param' => 'post_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the post object',
      ],
      2 =>
      [
        'name' => 'expand',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the results by adding additional information. `stats` - Adds statistics about the post(s]. `free_web_content` - Adds the web HTML rendered to a free reader. `free_email_content` - Adds the email HTML rendered to a free reader. `free_rss_content` - Adds the RSS feed HTML. `premium_web_content` - Adds the web HTML rendered to a premium reader. `premium_email_content` - Adds the email HTML rendered to a premium reader.',
      ],
      3 =>
      [
        'name' => 'premium_tiers',
        'param' => 'premium_tiers',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Scope any expanded content output to the specified premium tiers. This takes in an array of Display Names of the premium tiers. Note: This is case insensitive.',
      ],
    ],
  ],
  47 =>
  [
    'operation' => 'posts_update',
    'slug' => 'beehiiv_posts_update',
    'class' => 'BeehiivPostsUpdate',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/posts/{postId}',
    'name' => 'Update post OAuth Scope: posts:write',
    'description' => 'Execute official beehiiv API operation `posts_update`.

Endpoint: PATCH /publications/{publicationId}/posts/{postId}.',
    'type' => 'write',
    'tag' => 'Posts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'postId',
        'param' => 'post_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the post to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  48 =>
  [
    'operation' => 'publications_index',
    'slug' => 'beehiiv_publications_index',
    'class' => 'BeehiivPublicationsIndex',
    'method' => 'GET',
    'path' => '/publications',
    'name' => 'List publications OAuth Scope: publications:read',
    'description' => 'Execute official beehiiv API operation `publications_index`.

Endpoint: GET /publications.',
    'type' => 'read',
    'tag' => 'Publications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'expand',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the results by adding additional information like subscription counts and engagement stats.',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      3 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      4 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created `created` - The time in which the publication was first created. `name` - The name of the publication.',
      ],
    ],
  ],
  49 =>
  [
    'operation' => 'publications_show',
    'slug' => 'beehiiv_publications_show',
    'class' => 'BeehiivPublicationsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}',
    'name' => 'Get publication OAuth Scope: publications:read',
    'description' => 'Execute official beehiiv API operation `publications_show`.

Endpoint: GET /publications/{publicationId}.',
    'type' => 'read',
    'tag' => 'Publications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the results by adding additional information like subscription counts and engagement stats.',
      ],
    ],
  ],
  50 =>
  [
    'operation' => 'referralProgram_show',
    'slug' => 'beehiiv_referral_program_show',
    'class' => 'BeehiivReferralProgramShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/referral_program',
    'name' => 'Get referral program OAuth Scope: referral_program:read',
    'description' => 'Execute official beehiiv API operation `referralProgram_show`.

Endpoint: GET /publications/{publicationId}/referral_program.',
    'type' => 'read',
    'tag' => 'ReferralProgram',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      2 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
    ],
  ],
  51 =>
  [
    'operation' => 'segments_create',
    'slug' => 'beehiiv_segments_create',
    'class' => 'BeehiivSegmentsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/segments',
    'name' => 'Create segment',
    'description' => 'Execute official beehiiv API operation `segments_create`.

Endpoint: POST /publications/{publicationId}/segments.',
    'type' => 'write',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  52 =>
  [
    'operation' => 'segments_delete',
    'slug' => 'beehiiv_segments_delete',
    'class' => 'BeehiivSegmentsDelete',
    'method' => 'DELETE',
    'path' => '/publications/{publicationId}/segments/{segmentId}',
    'name' => 'Delete segment OAuth Scope: segments:write',
    'description' => 'Execute official beehiiv API operation `segments_delete`.

Endpoint: DELETE /publications/{publicationId}/segments/{segmentId}.',
    'type' => 'write',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'segmentId',
        'param' => 'segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the segment object',
      ],
    ],
  ],
  53 =>
  [
    'operation' => 'segments_expand_results',
    'slug' => 'beehiiv_segments_expand_results',
    'class' => 'BeehiivSegmentsExpandResults',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/segments/{segmentId}/results',
    'name' => 'List segment subscriber IDs OAuth Scope: segments:read',
    'description' => 'Execute official beehiiv API operation `segments_expand_results`.

Endpoint: GET /publications/{publicationId}/segments/{segmentId}/results.',
    'type' => 'read',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'segmentId',
        'param' => 'segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the segment object',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
    ],
  ],
  54 =>
  [
    'operation' => 'segments_index',
    'slug' => 'beehiiv_segments_index',
    'class' => 'BeehiivSegmentsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/segments',
    'name' => 'List segments OAuth Scope: segments:read',
    'description' => 'Execute official beehiiv API operation `segments_index`.

Endpoint: GET /publications/{publicationId}/segments.',
    'type' => 'read',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the segment\'s type.',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by the segment\'s status.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      4 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      5 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created `created` - The time in which the segment was first created. `last_calculated` - The time that the segment last completed calculation. Measured in seconds since the Unix epoch.',
      ],
      6 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      7 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Requests the most recently calculated statistics for a segment. Segment stats are recalculated once daily around 7 a.m. UTC for dynamic segments, but can be manually recalculated at any time in the dashboard. Manual and static segments only calculate once upon upload or creation.',
      ],
    ],
  ],
  55 =>
  [
    'operation' => 'segments_list_members',
    'slug' => 'beehiiv_segments_list_members',
    'class' => 'BeehiivSegmentsListMembers',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/segments/{segmentId}/members',
    'name' => 'List segment subscribers OAuth Scope: segments:read',
    'description' => 'Execute official beehiiv API operation `segments_list_members`.

Endpoint: GET /publications/{publicationId}/segments/{segmentId}/members.',
    'type' => 'read',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'segmentId',
        'param' => 'segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the segment object',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      4 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Returns statistics about the subscription(s]. `custom_fields` - Returns custom field values set on the subscription. `referrals` - Returns referrals made by the subscription. `tags` - Returns tags associated with the subscription. `subscription_premium_tiers` - Returns premium tier(s] the subscription is subscribed to.',
      ],
    ],
  ],
  56 =>
  [
    'operation' => 'segments_recalculate',
    'slug' => 'beehiiv_segments_recalculate',
    'class' => 'BeehiivSegmentsRecalculate',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/segments/{segmentId}/recalculate',
    'name' => 'Recalculate segment OAuth Scope: segments:write',
    'description' => 'Execute official beehiiv API operation `segments_recalculate`.

Endpoint: PUT /publications/{publicationId}/segments/{segmentId}/recalculate.',
    'type' => 'write',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'segmentId',
        'param' => 'segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the segment object',
      ],
    ],
  ],
  57 =>
  [
    'operation' => 'segments_show',
    'slug' => 'beehiiv_segments_show',
    'class' => 'BeehiivSegmentsShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/segments/{segmentId}',
    'name' => 'Get segment OAuth Scope: segments:read',
    'description' => 'Execute official beehiiv API operation `segments_show`.

Endpoint: GET /publications/{publicationId}/segments/{segmentId}.',
    'type' => 'read',
    'tag' => 'Segments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'segmentId',
        'param' => 'segment_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the segment object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the response to include additional data. `stats` - Requests the most recently calculated statistics for a segment. Segment stats are recalculated once daily around 7 a.m. UTC for dynamic segments, but can be manually recalculated at any time in the dashboard. Manual and static segments only calculate once upon upload or creation.',
      ],
    ],
  ],
  58 =>
  [
    'operation' => 'subscriptionTags_create',
    'slug' => 'beehiiv_subscription_tags_create',
    'class' => 'BeehiivSubscriptionTagsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}/tags',
    'name' => 'Add subscription tag OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptionTags_create`.

Endpoint: POST /publications/{publicationId}/subscriptions/{subscriptionId}/tags.',
    'type' => 'write',
    'tag' => 'SubscriptionTags',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Beehiiv parameter publicationId.',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Beehiiv parameter subscriptionId.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  59 =>
  [
    'operation' => 'subscriptions_create',
    'slug' => 'beehiiv_subscriptions_create',
    'class' => 'BeehiivSubscriptionsCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/subscriptions',
    'name' => 'Create subscription OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptions_create`.

Endpoint: POST /publications/{publicationId}/subscriptions.',
    'type' => 'write',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  60 =>
  [
    'operation' => 'subscriptions_delete',
    'slug' => 'beehiiv_subscriptions_delete',
    'class' => 'BeehiivSubscriptionsDelete',
    'method' => 'DELETE',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}',
    'name' => 'Delete subscription OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptions_delete`.

Endpoint: DELETE /publications/{publicationId}/subscriptions/{subscriptionId}.',
    'type' => 'write',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription object',
      ],
    ],
  ],
  61 =>
  [
    'operation' => 'subscriptions_get-by-email',
    'slug' => 'beehiiv_subscriptions_get_by_email',
    'class' => 'BeehiivSubscriptionsGetByEmail',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/subscriptions/by_email/{email}',
    'name' => 'Get subscription by email OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `subscriptions_get-by-email`.

Endpoint: GET /publications/{publicationId}/subscriptions/by_email/{email}.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'email',
        'param' => 'email',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the subscriber object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`subscription_premium_tiers ` - Returns an array of tiers the subscription is associated with.`referrals` - Returns an array of subscriptions with limited data - `id`, `email`, and `status`. These are the subscriptions that were referred by this subscription.`stats` - Returns statistics about the subscription(s].`custom_fields` - Returns an array of custom field values that have been set on the subscription. `tags` - Returns an array of tags that have been set on the subscription.`newsletter_lists` - Returns an array of newsletter list prefixed IDs the subscription is actively subscribed to.',
      ],
    ],
  ],
  62 =>
  [
    'operation' => 'subscriptions_get-by-id',
    'slug' => 'beehiiv_subscriptions_get_by_id',
    'class' => 'BeehiivSubscriptionsGetById',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}',
    'name' => 'Get subscription by ID OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `subscriptions_get-by-id`.

Endpoint: GET /publications/{publicationId}/subscriptions/{subscriptionId}.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`subscription_premium_tiers` - Returns an array of tiers the subscription is associated with.`referrals` - Returns an array of subscriptions with limited data - `id`, `email`, and `status`. These are the subscriptions that were referred by this subscription.`stats` - Returns statistics about the subscription(s].`custom_fields` - Returns an array of custom field values that have been set on the subscription. `tags` - Returns an array of tags that have been set on the subscription.`newsletter_lists` - Returns an array of newsletter list prefixed IDs the subscription is actively subscribed to.',
      ],
    ],
  ],
  63 =>
  [
    'operation' => 'subscriptions_get-by-subscriber-id',
    'slug' => 'beehiiv_subscriptions_get_by_subscriber_id',
    'class' => 'BeehiivSubscriptionsGetBySubscriberId',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/subscriptions/by_subscriber_id/{subscriberId}',
    'name' => 'Get subscription by subscriber ID OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `subscriptions_get-by-subscriber-id`.

Endpoint: GET /publications/{publicationId}/subscriptions/by_subscriber_id/{subscriberId}.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriberId',
        'param' => 'subscriber_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the subscriber object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`subscription_premium_tiers` - Returns an array of tiers the subscription is associated with.`referrals` - Returns an array of subscriptions with limited data - `id`, `email`, and `status`. These are the subscriptions that were referred by this subscription.`stats` - Returns statistics about the subscription(s].`custom_fields` - Returns an array of custom field values that have been set on the subscription.',
      ],
    ],
  ],
  64 =>
  [
    'operation' => 'subscriptions_get-jwt_token',
    'slug' => 'beehiiv_subscriptions_get_jwt_token',
    'class' => 'BeehiivSubscriptionsGetJwtToken',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}/jwt_token',
    'name' => 'Get subscription JWT token OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `subscriptions_get-jwt_token`.

Endpoint: GET /publications/{publicationId}/subscriptions/{subscriptionId}/jwt_token.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription object',
      ],
    ],
  ],
  65 =>
  [
    'operation' => 'subscriptions_index',
    'slug' => 'beehiiv_subscriptions_index',
    'class' => 'BeehiivSubscriptionsIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/subscriptions',
    'name' => 'List subscriptions OAuth Scope: subscriptions:read',
    'description' => 'Execute official beehiiv API operation `subscriptions_index`.

Endpoint: GET /publications/{publicationId}/subscriptions.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`subscription_premium_tiers ` - Returns an array of tiers the subscription is associated with.`referrals` - Returns an array of subscriptions with limited data - `id`, `email`, and `status`. These are the subscriptions that were referred by this subscription.`stats` - Returns statistics about the subscription(s].`custom_fields` - Returns an array of custom field values that have been set on the subscription. `newsletter_lists` - Returns an array of newsletter list prefixed IDs the subscription is actively subscribed to.',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by a status',
      ],
      3 =>
      [
        'name' => 'tier',
        'param' => 'tier',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optionally filter the results by a their tier',
      ],
      4 =>
      [
        'name' => 'premium_tiers[]',
        'param' => 'premium_tiers',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter the results by one or multiple premium tiers',
      ],
      5 =>
      [
        'name' => 'premium_tier_ids[]',
        'param' => 'premium_tier_ids',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally filter the results by one or multiple premium tier ids',
      ],
      6 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      7 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '**Cursor-based pagination (recommended]**: Use this opaque cursor token to fetch the next page of results. When provided, pagination will use cursor-based method which is more efficient and consistent than offset-based pagination. See the [Pagination Guide](/welcome/pagination] for more details.',
      ],
      8 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '**Offset-based pagination (deprecated]**: Page number for offset-based pagination. This method is deprecated and limited to 100 pages maximum. Please migrate to cursor-based pagination using the `cursor` parameter. If not specified, results 1-10 from page 1 will be returned. See the [Pagination Guide](/welcome/pagination] for migration guidance.',
      ],
      9 =>
      [
        'name' => 'email',
        'param' => 'email',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional email address to find a subscription.This param must be an exact match and is case insensitive.',
      ],
      10 =>
      [
        'name' => 'order_by',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The field that the results are sorted by. Defaults to created `created` - The time in which the subscription was first created.',
      ],
      11 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
      12 =>
      [
        'name' => 'creation_date',
        'param' => 'creation_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional date entry (in the format YYYY/MM/DD] that filters returned subscriptions by their creation date.',
      ],
    ],
  ],
  66 =>
  [
    'operation' => 'subscriptions_patch',
    'slug' => 'beehiiv_subscriptions_patch',
    'class' => 'BeehiivSubscriptionsPatch',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}',
    'name' => 'Update subscription by ID OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptions_patch`.

Endpoint: PATCH /publications/{publicationId}/subscriptions/{subscriptionId}.',
    'type' => 'write',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  67 =>
  [
    'operation' => 'subscriptions_put',
    'slug' => 'beehiiv_subscriptions_put',
    'class' => 'BeehiivSubscriptionsPut',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/subscriptions/{subscriptionId}',
    'name' => 'Update subscription by ID OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptions_put`.

Endpoint: PUT /publications/{publicationId}/subscriptions/{subscriptionId}.',
    'type' => 'write',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'subscriptionId',
        'param' => 'subscription_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the subscription object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  68 =>
  [
    'operation' => 'subscriptions_update-by-email',
    'slug' => 'beehiiv_subscriptions_update_by_email',
    'class' => 'BeehiivSubscriptionsUpdateByEmail',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/subscriptions/by_email/{email}',
    'name' => 'Update subscription by email OAuth Scope: subscriptions:write',
    'description' => 'Execute official beehiiv API operation `subscriptions_update-by-email`.

Endpoint: PUT /publications/{publicationId}/subscriptions/by_email/{email}.',
    'type' => 'write',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'email',
        'param' => 'email',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The email of the subscription object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  69 =>
  [
    'operation' => 'tiers_create',
    'slug' => 'beehiiv_tiers_create',
    'class' => 'BeehiivTiersCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/tiers',
    'name' => 'Create a tier OAuth Scope: tiers:write',
    'description' => 'Execute official beehiiv API operation `tiers_create`.

Endpoint: POST /publications/{publicationId}/tiers.',
    'type' => 'write',
    'tag' => 'Tiers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  70 =>
  [
    'operation' => 'tiers_index',
    'slug' => 'beehiiv_tiers_index',
    'class' => 'BeehiivTiersIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/tiers',
    'name' => 'List tiers OAuth Scope: tiers:read',
    'description' => 'Execute official beehiiv API operation `tiers_index`.

Endpoint: GET /publications/{publicationId}/tiers.',
    'type' => 'read',
    'tag' => 'Tiers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`stats` - Returns statistics about the tier(s].`prices` - Returns prices for the tier(s].',
      ],
      2 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
      3 =>
      [
        'name' => 'page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pagination returns the results in pages. Each page contains the number of results specified by the `limit` (default: 10].If not specified, results 1-10 from page 1 will be returned.',
      ],
      4 =>
      [
        'name' => 'direction',
        'param' => 'direction',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The direction that the results are sorted in. Defaults to asc `asc` - Ascending, sorts from smallest to largest. `desc` - Descending, sorts from largest to smallest.',
      ],
    ],
  ],
  71 =>
  [
    'operation' => 'tiers_patch',
    'slug' => 'beehiiv_tiers_patch',
    'class' => 'BeehiivTiersPatch',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/tiers/{tierId}',
    'name' => 'Update a tier OAuth Scope: tiers:write',
    'description' => 'Execute official beehiiv API operation `tiers_patch`.

Endpoint: PATCH /publications/{publicationId}/tiers/{tierId}.',
    'type' => 'write',
    'tag' => 'Tiers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'tierId',
        'param' => 'tier_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the tier object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  72 =>
  [
    'operation' => 'tiers_put',
    'slug' => 'beehiiv_tiers_put',
    'class' => 'BeehiivTiersPut',
    'method' => 'PUT',
    'path' => '/publications/{publicationId}/tiers/{tierId}',
    'name' => 'Update a tier OAuth Scope: tiers:write',
    'description' => 'Execute official beehiiv API operation `tiers_put`.

Endpoint: PUT /publications/{publicationId}/tiers/{tierId}.',
    'type' => 'write',
    'tag' => 'Tiers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'tierId',
        'param' => 'tier_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the tier object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  73 =>
  [
    'operation' => 'tiers_show',
    'slug' => 'beehiiv_tiers_show',
    'class' => 'BeehiivTiersShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/tiers/{tierId}',
    'name' => 'Get tier OAuth Scope: tiers:read',
    'description' => 'Execute official beehiiv API operation `tiers_show`.

Endpoint: GET /publications/{publicationId}/tiers/{tierId}.',
    'type' => 'read',
    'tag' => 'Tiers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'tierId',
        'param' => 'tier_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the tier object',
      ],
      2 =>
      [
        'name' => 'expand[]',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optional list of expandable objects.`stats` - Returns statistics about the tier(s].`prices` - Returns prices for the tier(s].',
      ],
    ],
  ],
  74 =>
  [
    'operation' => 'webhooks_create',
    'slug' => 'beehiiv_webhooks_create',
    'class' => 'BeehiivWebhooksCreate',
    'method' => 'POST',
    'path' => '/publications/{publicationId}/webhooks',
    'name' => 'Create a webhook OAuth Scope: webhooks:write',
    'description' => 'Execute official beehiiv API operation `webhooks_create`.

Endpoint: POST /publications/{publicationId}/webhooks.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  75 =>
  [
    'operation' => 'webhooks_delete',
    'slug' => 'beehiiv_webhooks_delete',
    'class' => 'BeehiivWebhooksDelete',
    'method' => 'DELETE',
    'path' => '/publications/{publicationId}/webhooks/{endpointId}',
    'name' => 'Delete a webhook OAuth Scope: webhooks:write',
    'description' => 'Execute official beehiiv API operation `webhooks_delete`.

Endpoint: DELETE /publications/{publicationId}/webhooks/{endpointId}.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'endpointId',
        'param' => 'endpoint_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the webhook object',
      ],
    ],
  ],
  76 =>
  [
    'operation' => 'webhooks_index',
    'slug' => 'beehiiv_webhooks_index',
    'class' => 'BeehiivWebhooksIndex',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/webhooks',
    'name' => 'List webhooks OAuth Scope: webhooks:read',
    'description' => 'Execute official beehiiv API operation `webhooks_index`.

Endpoint: GET /publications/{publicationId}/webhooks.',
    'type' => 'read',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'A limit on the number of objects to be returned. The limit can range between 1 and 100, and the default is 10.',
      ],
    ],
  ],
  77 =>
  [
    'operation' => 'webhooks_show',
    'slug' => 'beehiiv_webhooks_show',
    'class' => 'BeehiivWebhooksShow',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/webhooks/{endpointId}',
    'name' => 'Get webhook OAuth Scope: webhooks:read',
    'description' => 'Execute official beehiiv API operation `webhooks_show`.

Endpoint: GET /publications/{publicationId}/webhooks/{endpointId}.',
    'type' => 'read',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'endpointId',
        'param' => 'endpoint_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the webhook object',
      ],
    ],
  ],
  78 =>
  [
    'operation' => 'webhooks_test',
    'slug' => 'beehiiv_webhooks_test',
    'class' => 'BeehiivWebhooksTest',
    'method' => 'GET',
    'path' => '/publications/{publicationId}/webhooks/{endpointId}/tests',
    'name' => 'Test webhook OAuth Scope: webhooks:read',
    'description' => 'Execute official beehiiv API operation `webhooks_test`.

Endpoint: GET /publications/{publicationId}/webhooks/{endpointId}/tests.',
    'type' => 'read',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'endpointId',
        'param' => 'endpoint_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the webhook object',
      ],
    ],
  ],
  79 =>
  [
    'operation' => 'webhooks_update',
    'slug' => 'beehiiv_webhooks_update',
    'class' => 'BeehiivWebhooksUpdate',
    'method' => 'PATCH',
    'path' => '/publications/{publicationId}/webhooks/{endpointId}',
    'name' => 'Update webhook OAuth Scope: webhooks:write',
    'description' => 'Execute official beehiiv API operation `webhooks_update`.

Endpoint: PATCH /publications/{publicationId}/webhooks/{endpointId}.',
    'type' => 'write',
    'tag' => 'Webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'publicationId',
        'param' => 'publication_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the publication object',
      ],
      1 =>
      [
        'name' => 'endpointId',
        'param' => 'endpoint_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The prefixed ID of the webhook object',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official beehiiv OpenAPI schema.',
      ],
    ],
  ],
  80 =>
  [
    'operation' => 'workspaces_identify',
    'slug' => 'beehiiv_workspaces_identify',
    'class' => 'BeehiivWorkspacesIdentify',
    'method' => 'GET',
    'path' => '/workspaces/identify',
    'name' => 'Identify workspace OAuth Scope: identify:read',
    'description' => 'Execute official beehiiv API operation `workspaces_identify`.

Endpoint: GET /workspaces/identify.',
    'type' => 'read',
    'tag' => 'Workspaces',
    'parameters' =>
    [
    ],
  ],
  81 =>
  [
    'operation' => 'workspaces_publications-by-subscription-email',
    'slug' => 'beehiiv_workspaces_publications_by_subscription_email',
    'class' => 'BeehiivWorkspacesPublicationsBySubscriptionEmail',
    'method' => 'GET',
    'path' => '/workspaces/publications/by_subscription_email/{email}',
    'name' => 'Get publications by subscription email OAuth Scope: publications:read',
    'description' => 'Execute official beehiiv API operation `workspaces_publications-by-subscription-email`.

Endpoint: GET /workspaces/publications/by_subscription_email/{email}.',
    'type' => 'read',
    'tag' => 'Workspaces',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'email',
        'param' => 'email',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The email address to search for subscriptions',
      ],
      1 =>
      [
        'name' => 'expand',
        'param' => 'expand',
        'in' => 'query',
        'type' => 'array',
        'required' => false,
        'description' => 'Optionally expand the results by adding additional information. `subscription` - Returns the full Subscription object for the email address in each publication. `publication` - Returns the full Publication object instead of just ID and name. `subscription_custom_fields` - Returns custom field values nested within the subscription object. (Returns the subscription object regardless of whether `subscription` is requested.]',
      ],
    ],
  ],
];
    }
}
