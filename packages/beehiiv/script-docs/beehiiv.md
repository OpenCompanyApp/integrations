# beehiiv JavaScript Tools

Namespace: `beehiiv`

The beehiiv integration exposes 82 operations from the official OpenAPI specification. Use these tools for publications, posts, subscriptions, bulk subscription jobs, segments, automations, custom fields, newsletter lists, webhooks, tiers, polls, and workspace/user identification.

## Auth

Configure `api_key`. Configure `publication_id` once to omit it from publication-scoped calls, or pass `publication_id` per call.

## Examples

```js
var publications = app.integrations.beehiiv.publications_index({})

var posts = app.integrations.beehiiv.posts_index({
  publication_id: "pub_00000000-0000-0000-0000-000000000000",
  limit: 10,
})

var subscription = app.integrations.beehiiv.subscriptions_create({
  body: {
    email: "reader@example.test",
    reactivate_existing: false,
    send_welcome_email: false,
  }
})
```
## Common Tools

| Tool | Endpoint | Area |
|------|----------|------|
| `beehiiv_advertisement_opportunities_index` | GET `/publications/{publicationId}/advertisement_opportunities` | AdvertisementOpportunities |
| `beehiiv_authors_index` | GET `/publications/{publicationId}/authors` | Authors |
| `beehiiv_authors_show` | GET `/publications/{publicationId}/authors/{authorId}` | Authors |
| `beehiiv_automation_journeys_create` | POST `/publications/{publicationId}/automations/{automationId}/journeys` | AutomationJourneys |
| `beehiiv_automation_journeys_index` | GET `/publications/{publicationId}/automations/{automationId}/journeys` | AutomationJourneys |
| `beehiiv_automation_journeys_show` | GET `/publications/{publicationId}/automations/{automationId}/journeys/{automationJourneyId}` | AutomationJourneys |
| `beehiiv_automations_index` | GET `/publications/{publicationId}/automations` | Automations |
| `beehiiv_automations_list_emails` | GET `/publications/{publicationId}/automations/{automationId}/emails` | Automations |
| `beehiiv_automations_show` | GET `/publications/{publicationId}/automations/{automationId}` | Automations |
| `beehiiv_bulk_subscription_updates_index` | GET `/publications/{publicationId}/bulk_subscription_updates` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscription_updates_patch` | PATCH `/publications/{publicationId}/subscriptions/bulk_actions` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscription_updates_patch_status` | PATCH `/publications/{publicationId}/subscriptions` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscription_updates_put` | PUT `/publications/{publicationId}/subscriptions/bulk_actions` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscription_updates_put_status` | PUT `/publications/{publicationId}/subscriptions` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscription_updates_show` | GET `/publications/{publicationId}/bulk_subscription_updates/{id}` | BulkSubscriptionUpdates |
| `beehiiv_bulk_subscriptions_create` | POST `/publications/{publicationId}/bulk_subscriptions` | BulkSubscriptions |
| `beehiiv_condition_sets_index` | GET `/publications/{publicationId}/condition_sets` | ConditionSets |
| `beehiiv_condition_sets_show` | GET `/publications/{publicationId}/condition_sets/{conditionSetId}` | ConditionSets |
| `beehiiv_custom_fields_create` | POST `/publications/{publicationId}/custom_fields` | CustomFields |
| `beehiiv_custom_fields_delete` | DELETE `/publications/{publicationId}/custom_fields/{id}` | CustomFields |
| `beehiiv_custom_fields_index` | GET `/publications/{publicationId}/custom_fields` | CustomFields |
| `beehiiv_custom_fields_patch` | PATCH `/publications/{publicationId}/custom_fields/{id}` | CustomFields |
| `beehiiv_custom_fields_put` | PUT `/publications/{publicationId}/custom_fields/{id}` | CustomFields |
| `beehiiv_custom_fields_show` | GET `/publications/{publicationId}/custom_fields/{id}` | CustomFields |
| `beehiiv_data_deletion_create` | POST `/publications/{publicationId}/data_privacy/deletion_requests` | DataDeletion |
| `beehiiv_data_deletion_index` | GET `/publications/{publicationId}/data_privacy/deletion_requests` | DataDeletion |
| `beehiiv_data_deletion_show` | GET `/publications/{publicationId}/data_privacy/deletion_requests/{id}` | DataDeletion |
| `beehiiv_email_blasts_index` | GET `/publications/{publicationId}/email_blasts` | EmailBlasts |
| `beehiiv_email_blasts_show` | GET `/publications/{publicationId}/email_blasts/{emailBlastId}` | EmailBlasts |
| `beehiiv_engagements_index` | GET `/publications/{publicationId}/engagements` | Engagements |
| `beehiiv_newsletter_list_subscriptions_create` | POST `/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions` | NewsletterListSubscriptions |
| `beehiiv_newsletter_list_subscriptions_index` | GET `/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions` | NewsletterListSubscriptions |
| `beehiiv_newsletter_list_subscriptions_show` | GET `/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}` | NewsletterListSubscriptions |
| `beehiiv_newsletter_list_subscriptions_update` | PATCH `/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/{newsletterListSubscriptionId}` | NewsletterListSubscriptions |
| `beehiiv_newsletter_list_subscriptions_update_by_subscription_id` | PATCH `/publications/{publicationId}/newsletter_lists/{newsletterListId}/subscriptions/by_subscription_id/{subscriptionId}` | NewsletterListSubscriptions |
| `beehiiv_newsletter_lists_index` | GET `/publications/{publicationId}/newsletter_lists` | NewsletterLists |
| `beehiiv_newsletter_lists_show` | GET `/publications/{publicationId}/newsletter_lists/{newsletterListId}` | NewsletterLists |
| `beehiiv_oauth_users_identify` | GET `/users/identify` | OauthUsers |
| `beehiiv_polls_index` | GET `/publications/{publicationId}/polls` | Polls |
| `beehiiv_polls_list_responses` | GET `/publications/{publicationId}/polls/{pollId}/responses` | Polls |
| `beehiiv_polls_show` | GET `/publications/{publicationId}/polls/{pollId}` | Polls |
| `beehiiv_post_templates_index` | GET `/publications/{publicationId}/post_templates` | PostTemplates |
| `beehiiv_posts_aggregate_stats` | GET `/publications/{publicationId}/posts/aggregate_stats` | Posts |
| `beehiiv_posts_create` | POST `/publications/{publicationId}/posts` | Posts |
| `beehiiv_posts_delete` | DELETE `/publications/{publicationId}/posts/{postId}` | Posts |
| `beehiiv_posts_index` | GET `/publications/{publicationId}/posts` | Posts |
| `beehiiv_posts_show` | GET `/publications/{publicationId}/posts/{postId}` | Posts |
| `beehiiv_posts_update` | PATCH `/publications/{publicationId}/posts/{postId}` | Posts |
| `beehiiv_publications_index` | GET `/publications` | Publications |
| `beehiiv_publications_show` | GET `/publications/{publicationId}` | Publications |
| `beehiiv_referral_program_show` | GET `/publications/{publicationId}/referral_program` | ReferralProgram |
| `beehiiv_segments_create` | POST `/publications/{publicationId}/segments` | Segments |
| `beehiiv_segments_delete` | DELETE `/publications/{publicationId}/segments/{segmentId}` | Segments |
| `beehiiv_segments_expand_results` | GET `/publications/{publicationId}/segments/{segmentId}/results` | Segments |
| `beehiiv_segments_index` | GET `/publications/{publicationId}/segments` | Segments |
| `beehiiv_segments_list_members` | GET `/publications/{publicationId}/segments/{segmentId}/members` | Segments |
| `beehiiv_segments_recalculate` | PUT `/publications/{publicationId}/segments/{segmentId}/recalculate` | Segments |
| `beehiiv_segments_show` | GET `/publications/{publicationId}/segments/{segmentId}` | Segments |
| `beehiiv_subscription_tags_create` | POST `/publications/{publicationId}/subscriptions/{subscriptionId}/tags` | SubscriptionTags |
| `beehiiv_subscriptions_create` | POST `/publications/{publicationId}/subscriptions` | Subscriptions |
| `beehiiv_subscriptions_delete` | DELETE `/publications/{publicationId}/subscriptions/{subscriptionId}` | Subscriptions |
| `beehiiv_subscriptions_get_by_email` | GET `/publications/{publicationId}/subscriptions/by_email/{email}` | Subscriptions |
| `beehiiv_subscriptions_get_by_id` | GET `/publications/{publicationId}/subscriptions/{subscriptionId}` | Subscriptions |
| `beehiiv_subscriptions_get_by_subscriber_id` | GET `/publications/{publicationId}/subscriptions/by_subscriber_id/{subscriberId}` | Subscriptions |
| `beehiiv_subscriptions_get_jwt_token` | GET `/publications/{publicationId}/subscriptions/{subscriptionId}/jwt_token` | Subscriptions |
| `beehiiv_subscriptions_index` | GET `/publications/{publicationId}/subscriptions` | Subscriptions |
| `beehiiv_subscriptions_patch` | PATCH `/publications/{publicationId}/subscriptions/{subscriptionId}` | Subscriptions |
| `beehiiv_subscriptions_put` | PUT `/publications/{publicationId}/subscriptions/{subscriptionId}` | Subscriptions |
| `beehiiv_subscriptions_update_by_email` | PUT `/publications/{publicationId}/subscriptions/by_email/{email}` | Subscriptions |
| `beehiiv_tiers_create` | POST `/publications/{publicationId}/tiers` | Tiers |
| `beehiiv_tiers_index` | GET `/publications/{publicationId}/tiers` | Tiers |
| `beehiiv_tiers_patch` | PATCH `/publications/{publicationId}/tiers/{tierId}` | Tiers |
| `beehiiv_tiers_put` | PUT `/publications/{publicationId}/tiers/{tierId}` | Tiers |
| `beehiiv_tiers_show` | GET `/publications/{publicationId}/tiers/{tierId}` | Tiers |
| `beehiiv_webhooks_create` | POST `/publications/{publicationId}/webhooks` | Webhooks |
| `beehiiv_webhooks_delete` | DELETE `/publications/{publicationId}/webhooks/{endpointId}` | Webhooks |
| `beehiiv_webhooks_index` | GET `/publications/{publicationId}/webhooks` | Webhooks |
| `beehiiv_webhooks_show` | GET `/publications/{publicationId}/webhooks/{endpointId}` | Webhooks |
| `beehiiv_webhooks_test` | GET `/publications/{publicationId}/webhooks/{endpointId}/tests` | Webhooks |
| `beehiiv_webhooks_update` | PATCH `/publications/{publicationId}/webhooks/{endpointId}` | Webhooks |

The full generated catalog contains all operations from the official beehiiv OpenAPI spec.