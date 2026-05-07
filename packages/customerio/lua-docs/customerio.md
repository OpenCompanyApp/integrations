# Customer.io Integration

Namespace: `app.integrations.customerio`.

This integration follows Customer.io OpenAPI JSON specs for the App, Track, and Pipelines APIs. Use top-level snake_case arguments for path and query parameters. Use `payload` for JSON request bodies.

Auth notes: App API tools use `api_key` as a bearer token. Track API tools use `site_id` and `track_api_key`. Pipelines API tools use `pipelines_api_key` as the Basic auth username with a blank password.

## Tools

### customerio_app_add_collection
Create a new collection and provide the data that you'll access from the collection or the url that you'll download CSV or JSON data from.

- API: `App API`
- Method/path: `POST /v1/collections`
- Parameters: none
- Body: `payload`

### customerio_app_broadcast_action_links
Returns link click metrics for an individual broadcast action.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/actions/{action_id}/metrics/links`
- Parameters: `broadcast_id` required, `action_id` required, `period`, `steps`, `type`

### customerio_app_broadcast_action_metrics
Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a period of time.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/actions/{action_id}/metrics`
- Parameters: `broadcast_id` required, `action_id` required, `period`, `steps`, `type`

### customerio_app_broadcast_actions
Returns the actions that occur as a part of a broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/actions`
- Parameters: `broadcast_id` required

### customerio_app_broadcast_errors
If your broadcast produced validation errors, this endpoint can help you better understand what went wrong.

- API: `App API`
- Method/path: `GET /v1/campaigns/{broadcast_id}/triggers/{trigger_id}/errors`
- Parameters: `broadcast_id` required, `trigger_id` required, `start`, `limit`

### customerio_app_broadcast_links
Returns metrics for link clicks within a broadcast, both in total and in series periods (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/metrics/links`
- Parameters: `broadcast_id` required, `period`, `steps`, `unique`

### customerio_app_broadcast_messages
Returns information about the deliveries (instances of messages sent to individual people) sent from an API-triggered broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/messages`
- Parameters: `broadcast_id` required, `start`, `limit`, `metric`, `state`, `type`, `start_ts`, `end_ts`, `get_tracked_responses`

### customerio_app_broadcast_metrics
Returns a list of metrics for an individual broadcast in steps (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/metrics`
- Parameters: `broadcast_id` required, `period`, `steps`, `type`

### customerio_app_broadcast_status
After triggering a broadcast you can retrieve the status of that broadcast using a GET of the trigger_id.

- API: `App API`
- Method/path: `GET /v1/campaigns/{broadcast_id}/triggers/{trigger_id}`
- Parameters: `broadcast_id` required, `trigger_id` required

### customerio_app_campaign_action_links
Returns link click metrics for an individual action.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/actions/{action_id}/metrics/links`
- Parameters: `campaign_id` required, `action_id` required, `period`, `steps`, `type`

### customerio_app_campaign_action_metrics
Returns a list of metrics for an individual action.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/actions/{action_id}/metrics`
- Parameters: `campaign_id` required, `action_id` required, `version` required, `type`, `res`, `tz`, `start`, `end`, `period`, `steps`

### customerio_app_campaign_journey_metrics
Returns a list of Journey Metrics for your campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/journey_metrics`
- Parameters: `campaign_id` required, `start` required, `end` required, `res` required

### customerio_app_campaign_link_metrics
Returns metrics for link clicks within a campaign, both in total and in series periods (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/metrics/links`
- Parameters: `campaign_id` required, `period`, `steps`, `unique`

### customerio_app_campaign_metrics
Returns a list of metrics for an individual campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/metrics`
- Parameters: `campaign_id` required, `version` required, `type`, `res`, `tz`, `start`, `end`, `period`, `steps`

### customerio_app_create_asset
Creates a new file asset.

- API: `App API`
- Method/path: `POST /v1/assets/files`
- Parameters: none
- Body: `payload` required

### customerio_app_create_asset_folder
Creates a new folder for organizing file assets.

- API: `App API`
- Method/path: `POST /v1/assets/folders`
- Parameters: none
- Body: `payload` required

### customerio_app_create_component
Creates a custom component.

- API: `App API`
- Method/path: `POST /v1/design_studio/components`
- Parameters: none
- Body: `payload` required

### customerio_app_create_email
Create an email.

- API: `App API`
- Method/path: `POST /v1/design_studio/emails`
- Parameters: none
- Body: `payload` required

### customerio_app_create_email_translation
Creates a new translation for an email.

- API: `App API`
- Method/path: `POST /v1/design_studio/emails/{id}/languages`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_create_folder
Create a new folder at the root level or under a parent folder.

- API: `App API`
- Method/path: `POST /v1/design_studio/folders`
- Parameters: none
- Body: `payload` required

### customerio_app_create_man_segment
Create a manual segment with a name and a description.

- API: `App API`
- Method/path: `POST /v1/segments`
- Parameters: none
- Body: `payload`

### customerio_app_create_newsletter
Create a newsletter and optionally schedule it or send it immediately.

- API: `App API`
- Method/path: `POST /v1/newsletters`
- Parameters: none
- Body: `payload` required

### customerio_app_create_newsletter_language_variant
Add a language variant to a newsletter.

- API: `App API`
- Method/path: `POST /v1/newsletters/{newsletter_id}/language`
- Parameters: `newsletter_id` required
- Body: `payload` required

### customerio_app_create_newsletter_test_group
Create a new A/B test group for a newsletter.

- API: `App API`
- Method/path: `POST /v1/newsletters/{newsletter_id}/test_groups`
- Parameters: `newsletter_id` required
- Body: `payload`

### customerio_app_create_newsletter_test_language_variant
Add a language variant to a specific A/B test group in a newsletter.

- API: `App API`
- Method/path: `POST /v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language`
- Parameters: `newsletter_id` required, `test_group_id` required
- Body: `payload` required

### customerio_app_create_snippet
Create a new snippet.

- API: `App API`
- Method/path: `POST /v1/snippets`
- Parameters: none
- Body: `payload`

### customerio_app_create_webhook
Create a new webhook configuration.

- API: `App API`
- Method/path: `POST /v1/reporting_webhooks`
- Parameters: none
- Body: `payload`

### customerio_app_delete_asset
Soft-deletes a file asset by setting its deleted_at timestamp.

- API: `App API`
- Method/path: `DELETE /v1/assets/files/{id}`
- Parameters: `id` required

### customerio_app_delete_asset_folder
Soft-deletes an empty folder.

- API: `App API`
- Method/path: `DELETE /v1/assets/folders/{id}`
- Parameters: `id` required

### customerio_app_delete_collection
Remove a collection and associated contents.

- API: `App API`
- Method/path: `DELETE /v1/collections/{collection_id}`
- Parameters: `collection_id` required

### customerio_app_delete_component
Delete a component.

- API: `App API`
- Method/path: `DELETE /v1/design_studio/components/{id}`
- Parameters: `id` required

### customerio_app_delete_email
Delete an email.

- API: `App API`
- Method/path: `DELETE /v1/design_studio/emails/{id}`
- Parameters: `id` required

### customerio_app_delete_email_translation
Delete a specific language translation from an email.

- API: `App API`
- Method/path: `DELETE /v1/design_studio/emails/{id}/languages/{language}`
- Parameters: `id` required, `language` required

### customerio_app_delete_folder
Delete a folder **including subfolders and all file (components, templates, and emails)**.

- API: `App API`
- Method/path: `DELETE /v1/design_studio/folders/{id}`
- Parameters: `id` required

### customerio_app_delete_man_segment
Delete a manual segment.

- API: `App API`
- Method/path: `DELETE /v1/segments/{segment_id}`
- Parameters: `segment_id` required

### customerio_app_delete_newsletter_language_variant
Delete a specific language variant of a newsletter.

- API: `App API`
- Method/path: `DELETE /v1/newsletters/{newsletter_id}/language/{language}`
- Parameters: `newsletter_id` required, `language` required

### customerio_app_delete_newsletter_test_language_variant
Delete a specific language variant of a newsletter in an A/B test group.

- API: `App API`
- Method/path: `DELETE /v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}`
- Parameters: `newsletter_id` required, `test_group_id` required, `language` required

### customerio_app_delete_newsletters
Deletes an individual newsletter, including content, settings, and metrics.

- API: `App API`
- Method/path: `DELETE /v1/newsletters/{newsletter_id}`
- Parameters: `newsletter_id` required

### customerio_app_delete_snippet
Remove a snippet.

- API: `App API`
- Method/path: `DELETE /v1/snippets/{snippet_name}`
- Parameters: `snippet_name` required

### customerio_app_delete_suppression
Remove an address from the ESP's suppression list.

- API: `App API`
- Method/path: `DELETE /v1/esp/suppression/{suppression_type}/{email_address}`
- Parameters: `suppression_type` required, `email_address` required

### customerio_app_delete_webhook
Delete a reporting webhook's configuration.

- API: `App API`
- Method/path: `DELETE /v1/reporting_webhooks/{webhook_id}`
- Parameters: `webhook_id` required

### customerio_app_download_export
This endpoint returns a signed link to download an export.

- API: `App API`
- Method/path: `GET /v1/exports/{export_id}/download`
- Parameters: `export_id` required

### customerio_app_export_deliveries_data
Provide filters for the newsletter, campaign, or action you want to return delivery information from.

- API: `App API`
- Method/path: `POST /v1/exports/deliveries`
- Parameters: none
- Body: `payload`

### customerio_app_export_people_data
Provide filters and attributes describing the customers you want to export.

- API: `App API`
- Method/path: `POST /v1/exports/customers`
- Parameters: none
- Body: `payload`

### customerio_app_get_archived_message
Returns the archived copy of a delivery, including the message body, recipient, and metrics.

- API: `App API`
- Method/path: `GET /v1/messages/{message_id}/archived_message`
- Parameters: `message_id` required

### customerio_app_get_asset
Retrieves a single file asset by its ID.

- API: `App API`
- Method/path: `GET /v1/assets/files/{id}`
- Parameters: `id` required

### customerio_app_get_asset_folder
Retrieves a single folder by its ID.

- API: `App API`
- Method/path: `GET /v1/assets/folders/{id}`
- Parameters: `id` required

### customerio_app_get_broadcast
Returns metadata for an individual broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}`
- Parameters: `broadcast_id` required

### customerio_app_get_broadcast_action
Returns information about a specific action within a broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/actions/{action_id}`
- Parameters: `broadcast_id` required, `action_id` required

### customerio_app_get_broadcast_action_language
Returns information about a translation of message in a broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/actions/{action_id}/language/{language}`
- Parameters: `broadcast_id` required, `action_id` required, `language` required

### customerio_app_get_campaign_action
Returns information about a specific action in a campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/actions/{action_id}`
- Parameters: `campaign_id` required, `action_id` required

### customerio_app_get_campaign_action_translation
Returns a translated version of a message in a campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/actions/{action_id}/language/{language}`
- Parameters: `campaign_id` required, `action_id` required, `language` required

### customerio_app_get_campaign_messages
Returns information about the deliveries (instances of messages sent to individual people) sent from a campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/messages`
- Parameters: `campaign_id` required, `start`, `limit`, `type`, `metric`, `drafts`, `start_ts`, `end_ts`, `get_tracked_responses`

### customerio_app_get_campaigns
Returns metadata for an individual campaign.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}`
- Parameters: `campaign_id` required

### customerio_app_get_channels
Returns a list of subscription channels available in your workspace.

- API: `App API`
- Method/path: `GET /v1/subscription_channels`
- Parameters: none

### customerio_app_get_cio_allowlist
Returns a list of IP addresses that you need to allowlist if you're using a firewall or provider's IP access management settings to deny access to unknown IP addresses.

- API: `App API`
- Method/path: `GET /v1/info/ip_addresses`
- Parameters: none

### customerio_app_get_collection
Retrieves details about a collection, including the schema and name.

- API: `App API`
- Method/path: `GET /v1/collections/{collection_id}`
- Parameters: `collection_id` required

### customerio_app_get_collection_contents
Retrieve the contents of a collection (the data from when you created or updated a collection).

- API: `App API`
- Method/path: `GET /v1/collections/{collection_id}/content`
- Parameters: `collection_id` required

### customerio_app_get_collections
Returns a list of all of your collections, including the name and schema for each collection.

- API: `App API`
- Method/path: `GET /v1/collections`
- Parameters: none

### customerio_app_get_component
Returns a single component with its full content.

- API: `App API`
- Method/path: `GET /v1/design_studio/components/{id}`
- Parameters: `id` required

### customerio_app_get_domain_suppressions_by_type
Find addresses suppressed by the Email Service Provider (ESP) for a particular reason on a specific sending domain.

- API: `App API`
- Method/path: `GET /v1/esp/domains/{domain_name}/suppression/{suppression_type}`
- Parameters: `domain_name` required, `suppression_type` required, `limit`, `start`, `email`

### customerio_app_get_email
Returns a single email including content, envelope details, and transformers.

- API: `App API`
- Method/path: `GET /v1/design_studio/emails/{id}`
- Parameters: `id` required

### customerio_app_get_email_translation
Returns a single email translation by language code, including content, envelope, and transformers.

- API: `App API`
- Method/path: `GET /v1/design_studio/emails/{id}/languages/{language}`
- Parameters: `id` required, `language` required

### customerio_app_get_export
Return information about a specific export.

- API: `App API`
- Method/path: `GET /v1/exports/{export_id}`
- Parameters: `export_id` required

### customerio_app_get_folder
Get a folder by its UUID.

- API: `App API`
- Method/path: `GET /v1/design_studio/folders/{id}`
- Parameters: `id` required

### customerio_app_get_import
This endpoint returns information about an "import"a CSV file containing a group of people or events you uploaded to using v1/imports endpoint.

- API: `App API`
- Method/path: `GET /v1/imports/{import_id}`
- Parameters: `import_id` required

### customerio_app_get_message
Return a information about, and metrics for, a deliverythe instance of a message intended for an individual recipient person.

- API: `App API`
- Method/path: `GET /v1/messages/{message_id}`
- Parameters: `message_id` required, `get_tracked_responses`

### customerio_app_get_newsletter_links
Returns metrics for link clicks within a newsletter, both in total and in series periods (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/metrics/links`
- Parameters: `newsletter_id` required, `period`, `steps`, `unique`

### customerio_app_get_newsletter_metrics
Returns a list of metrics for an individual newsletter in steps (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/metrics`
- Parameters: `newsletter_id` required, `period`, `steps`, `type`

### customerio_app_get_newsletter_msg_meta
Returns information about the "deliveries" (rendered messages) sent to your recipients for a specific newsletter.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/messages`
- Parameters: `newsletter_id` required, `start`, `limit`, `metric`, `start_ts`, `end_ts`, `get_tracked_responses`

### customerio_app_get_newsletter_test_groups
Returns information about each test group in a newsletter, including content ids for each group.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/test_groups`
- Parameters: `newsletter_id` required

### customerio_app_get_newsletter_variant
Returns information about a specific variant of a newsletter, where a variant is either a language in a multi-language newsletter or a part of an A/B test.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/contents/{content_id}`
- Parameters: `newsletter_id` required, `content_id` required

### customerio_app_get_newsletter_variant_translation
Returns information about a specific language variant of a newsletter.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/language/{language}`
- Parameters: `newsletter_id` required, `language` required

### customerio_app_get_newsletter_variant_translation_test
Returns information about a specific language variant of a newsletter in an A/B test group.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}`
- Parameters: `newsletter_id` required, `test_group_id` required, `language` required

### customerio_app_get_newsletters
Returns metadata for an individual newsletter.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}`
- Parameters: `newsletter_id` required

### customerio_app_get_object_attributes
Get a list of attributes for an object.

- API: `App API`
- Method/path: `GET /v1/objects/{object_type_id}/{object_id}/attributes`
- Parameters: `object_type_id` required, `object_id` required, `id_type`

### customerio_app_get_object_relationships
Get a list of people people related to an object.

- API: `App API`
- Method/path: `GET /v1/objects/{object_type_id}/{object_id}/relationships`
- Parameters: `object_type_id` required, `object_id` required, `start`, `limit`, `id_type`

### customerio_app_get_object_types
Returns a list of object types in your system.

- API: `App API`
- Method/path: `GET /v1/object_types`
- Parameters: none

### customerio_app_get_objects_filter
Use a set of filter conditions to find objects in your workspace.

- API: `App API`
- Method/path: `POST /v1/objects`
- Parameters: `start`, `limit`
- Body: `payload`

### customerio_app_get_people_by_id
Return attributes and devices for up to 100 customers by ID.

- API: `App API`
- Method/path: `POST /v1/customers/attributes`
- Parameters: none
- Body: `payload`

### customerio_app_get_people_email
Return a list of people in your workspace matching an email address.

- API: `App API`
- Method/path: `GET /v1/customers`
- Parameters: `email` required

### customerio_app_get_people_filter
Provide a filter to search for people in your workspace.

- API: `App API`
- Method/path: `POST /v1/customers`
- Parameters: `start`, `limit`
- Body: `payload`

### customerio_app_get_person_activities
Return a list of activities performed by, or for, a customer.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/activities`
- Parameters: `customer_id` required, `id_type`, `start`, `limit`, `type`, `name`

### customerio_app_get_person_attributes
Return a list of attributes for a customer profile.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/attributes`
- Parameters: `customer_id` required, `id_type`

### customerio_app_get_person_messages
Returns information about the deliveries sent to a person.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/messages`
- Parameters: `customer_id` required, `id_type`, `start`, `limit`, `start_ts`, `end_ts`

### customerio_app_get_person_relationships
Return a list of objects that a person is related to.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/relationships`
- Parameters: `customer_id` required, `start`, `limit`

### customerio_app_get_person_segments
Returns a list of segments that a customer profile belongs to.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/segments`
- Parameters: `customer_id` required, `id_type`

### customerio_app_get_person_subscription_preferences
Returns a list of subscription preferences for a person, including the custom header of the subscription preferences page, topic names, and topic descriptions.

- API: `App API`
- Method/path: `GET /v1/customers/{customer_id}/subscription_preferences`
- Parameters: `customer_id` required, `id_type`, `language`, `accept_language`

### customerio_app_get_segment
Return information about a segment.

- API: `App API`
- Method/path: `GET /v1/segments/{segment_id}`
- Parameters: `segment_id` required

### customerio_app_get_segment_count
Returns the membership count for a segment.

- API: `App API`
- Method/path: `GET /v1/segments/{segment_id}/customer_count`
- Parameters: `segment_id` required

### customerio_app_get_segment_dependencies
Use this endpoint to find out which campaigns and newsletters use a segment.

- API: `App API`
- Method/path: `GET /v1/segments/{segment_id}/used_by`
- Parameters: `segment_id` required

### customerio_app_get_segment_membership
Returns customers in a segment.

- API: `App API`
- Method/path: `GET /v1/segments/{segment_id}/membership`
- Parameters: `segment_id` required, `start`, `limit`

### customerio_app_get_sender
Returns information about a specific sender.

- API: `App API`
- Method/path: `GET /v1/sender_identities/{sender_id}`
- Parameters: `sender_id` required

### customerio_app_get_sender_usage
Returns lists of the campaigns and newsletters that use a sender.

- API: `App API`
- Method/path: `GET /v1/sender_identities/{sender_id}/used_by`
- Parameters: `sender_id` required

### customerio_app_get_subscription_center_token
Generates a signed token and URL for a person's standalone subscription center page.

- API: `App API`
- Method/path: `GET /v1/subscription_center/{customer_id}/token`
- Parameters: `customer_id` required

### customerio_app_get_suppression
Look up an email address to learn if, and why, it was suppressed by the email service provider (ESP).

- API: `App API`
- Method/path: `GET /v1/esp/search_suppression/{email_address}`
- Parameters: `email_address` required

### customerio_app_get_suppression_by_type
Find addresses suppressed by the Email Service Provider (ESP) for a particular reasonbounces, blocks, spam reports, or invalid email addresses.

- API: `App API`
- Method/path: `GET /v1/esp/suppression/{suppression_type}`
- Parameters: `suppression_type` required, `limit`, `offset`, `domain`

### customerio_app_get_topics
Returns a list of subscription topics in your workspace.

- API: `App API`
- Method/path: `GET /v1/subscription_topics`
- Parameters: none

### customerio_app_get_transactional
Returns information about an individual transactional message.

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}`
- Parameters: `transactional_id` required

### customerio_app_get_transactional_variant
Returns information about a translation of an individual transactional message, including the message content.

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}/language/{language}`
- Parameters: `transactional_id` required, `language` required

### customerio_app_get_variant_links
Returns link click metrics for an individual newsletter variantan individual language in a multi-language newsletter or a message in an A/B test.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/contents/{content_id}/metrics/links`
- Parameters: `newsletter_id` required, `content_id` required, `period`, `steps`, `type`

### customerio_app_get_variant_metrics
Returns a metrics for an individual newsletter varianteither an individual language in a multi-language newsletter or a message in an A/B test.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/contents/{content_id}/metrics`
- Parameters: `newsletter_id` required, `content_id` required, `period`, `steps`, `type`

### customerio_app_get_webhook
Returns information about a specific reporting webhook.

- API: `App API`
- Method/path: `GET /v1/reporting_webhooks/{webhook_id}`
- Parameters: `webhook_id` required

### customerio_app_import
This endpoint lets you upload a CSV file containing people, events, objects, or relationships.

- API: `App API`
- Method/path: `POST /v1/imports`
- Parameters: none
- Body: `payload`

### customerio_app_list_activities
This endpoint returns a list of "activities" for people, similar to your workspace's Activity Logs.

- API: `App API`
- Method/path: `GET /v1/activities`
- Parameters: `start`, `type`, `name`, `deleted`, `customer_id`, `id_type`, `limit`

### customerio_app_list_asset_folders
Returns a paginated list of asset folders.

- API: `App API`
- Method/path: `GET /v1/assets/folders`
- Parameters: `parent_folder_id`, `direct_descendants_only`, `page`, `limit`

### customerio_app_list_assets
Returns a paginated list of file assets.

- API: `App API`
- Method/path: `GET /v1/assets`
- Parameters: `parent_folder_id`, `direct_descendants_only`, `page`, `limit`

### customerio_app_list_broadcast_triggers
Returns a list of the triggers for a broadcast.

- API: `App API`
- Method/path: `GET /v1/broadcasts/{broadcast_id}/triggers`
- Parameters: `broadcast_id` required

### customerio_app_list_broadcasts
Returns a list of your API-triggered broadcasts and associated metadata.

- API: `App API`
- Method/path: `GET /v1/broadcasts`
- Parameters: none

### customerio_app_list_campaign_actions
Returns the operations in a campaign workflow.

- API: `App API`
- Method/path: `GET /v1/campaigns/{campaign_id}/actions`
- Parameters: `campaign_id` required, `start`

### customerio_app_list_campaigns
Returns a list of your campaigns and associated metadata.

- API: `App API`
- Method/path: `GET /v1/campaigns`
- Parameters: none

### customerio_app_list_components
Returns a paginated list of components and any folders in the result set.

- API: `App API`
- Method/path: `GET /v1/design_studio/components`
- Parameters: `tag`, `page`, `limit`, `parent_folder_id`, `direct_descendants_only`, `sort_by`, `sort_order`, `created_before`, `created_after`, `updated_before`, `updated_after`

### customerio_app_list_email_translations
Returns all translations for an email.

- API: `App API`
- Method/path: `GET /v1/design_studio/emails/{id}/languages`
- Parameters: `id` required

### customerio_app_list_emails
Returns a paginated list of emails and a separate array of folders that the emails belong to.

- API: `App API`
- Method/path: `GET /v1/design_studio/emails`
- Parameters: `page`, `limit`, `parent_folder_id`, `direct_descendants_only`, `sort_by`, `sort_order`, `created_before`, `created_after`, `updated_before`, `updated_after`, `is_template`, `has_translations`, `is_linked`

### customerio_app_list_exports
Return a list of your exports.

- API: `App API`
- Method/path: `GET /v1/exports`
- Parameters: none

### customerio_app_list_folders
Returns a paginated list of folders.

- API: `App API`
- Method/path: `GET /v1/design_studio/folders`
- Parameters: `page`, `limit`, `parent_folder_id`, `direct_descendants_only`, `sort_by`, `sort_order`, `created_before`, `created_after`, `updated_before`, `updated_after`

### customerio_app_list_messages
Return a list of deliveries, including metrics for each delivery, for messages in your workspace.

- API: `App API`
- Method/path: `GET /v1/messages`
- Parameters: `start`, `limit`, `type`, `metric`, `drafts`, `campaign_id`, `newsletter_id`, `action_id`, `start_ts`, `end_ts`, `get_tracked_responses`

### customerio_app_list_newsletter_variants
Returns a newsletter's content variantsthese are either different languages in a multi-language newsletter or A/B tests.

- API: `App API`
- Method/path: `GET /v1/newsletters/{newsletter_id}/contents`
- Parameters: `newsletter_id` required

### customerio_app_list_newsletters
Returns a list of your newsletters and associated metadata.

- API: `App API`
- Method/path: `GET /v1/newsletters`
- Parameters: `limit`, `sort`, `start`

### customerio_app_list_segments
Retrieve a list of all of your segments.

- API: `App API`
- Method/path: `GET /v1/segments`
- Parameters: none

### customerio_app_list_senders
Returns a list of senders in your workspace.

- API: `App API`
- Method/path: `GET /v1/sender_identities`
- Parameters: `start`, `limit`, `sort`

### customerio_app_list_snippets
Returns a list of snippets in your workspace.

- API: `App API`
- Method/path: `GET /v1/snippets`
- Parameters: none

### customerio_app_list_transactional
Returns a list of your transactional messagesthe transactional IDs that you use to trigger an individual transactional delivery.

- API: `App API`
- Method/path: `GET /v1/transactional`
- Parameters: none

### customerio_app_list_transactional_variants
Returns the content variants of a transactional message, where each variant represents a different language.

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}/contents`
- Parameters: `transactional_id` required

### customerio_app_list_webhooks
Return a list of all of your reporting webhooks.

- API: `App API`
- Method/path: `GET /v1/reporting_webhooks`
- Parameters: none

### customerio_app_list_workspaces
Returns a list of workspaces in your account.

- API: `App API`
- Method/path: `GET /v1/workspaces`
- Parameters: none

### customerio_app_post_suppression
Suppress an email address at the email service provider (ESP).

- API: `App API`
- Method/path: `POST /v1/esp/suppression/{suppression_type}/{email_address}`
- Parameters: `suppression_type` required, `email_address` required

### customerio_app_schedule_newsletter
Schedule a newsletter to send at a specific time.

- API: `App API`
- Method/path: `POST /v1/newsletters/{newsletter_id}/schedule`
- Parameters: `newsletter_id` required
- Body: `payload` required

### customerio_app_send_email
Send a transactional email.

- API: `App API`
- Method/path: `POST /v1/send/email`
- Parameters: none
- Body: `payload`

### customerio_app_send_inbox_message
Send a transactional inbox message.

- API: `App API`
- Method/path: `POST /v1/send/inbox_message`
- Parameters: none
- Body: `payload`

### customerio_app_send_newsletter
Send a newsletter immediately.

- API: `App API`
- Method/path: `POST /v1/newsletters/{newsletter_id}/send`
- Parameters: `newsletter_id` required
- Body: `payload`

### customerio_app_send_push
Send a transactional push.

- API: `App API`
- Method/path: `POST /v1/send/push`
- Parameters: none
- Body: `payload`

### customerio_app_send_sms
Send a transactional SMS message.

- API: `App API`
- Method/path: `POST /v1/send/sms`
- Parameters: none
- Body: `payload`

### customerio_app_transactional_links
Returns metrics for clicked links from a transactional message, both in total and in series periods (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}/metrics/links`
- Parameters: `transactional_id` required, `period`, `steps`, `unique`

### customerio_app_transactional_messages
Returns information about the deliveries (instances of messages sent to individual people) from a transactional message.

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}/messages`
- Parameters: `transactional_id` required, `start`, `limit`, `metric`, `state`, `start_ts`, `end_ts`, `get_tracked_responses`

### customerio_app_transactional_metrics
Returns a list of metrics for a transactional message in steps (days, weeks, etc).

- API: `App API`
- Method/path: `GET /v1/transactional/{transactional_id}/metrics`
- Parameters: `transactional_id` required, `period`, `steps`

### customerio_app_trigger_broadcast
Trigger a broadcast (not a newsletter) and optionally provide data to populate liquid placeholders in the message.

- API: `App API`
- Method/path: `POST /v1/campaigns/{broadcast_id}/triggers`
- Parameters: `broadcast_id` required
- Body: `payload`

### customerio_app_update_asset
Updates the name and/or parent folder of a file asset.

- API: `App API`
- Method/path: `PUT /v1/assets/files/{id}`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_update_asset_folder
Updates the name and/or parent folder of an existing folder.

- API: `App API`
- Method/path: `PUT /v1/assets/folders/{id}`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_update_attribute_metadata
Attributes are customer data like their name and email.

- API: `App API`
- Method/path: `POST /v1/data_index/attributes`
- Parameters: none
- Body: `payload` required

### customerio_app_update_broadcast_action
Update the contents of a broadcast action, including the body of messages or HTTP requests.

- API: `App API`
- Method/path: `PUT /v1/broadcasts/{broadcast_id}/actions/{action_id}`
- Parameters: `broadcast_id` required, `action_id` required
- Body: `payload`

### customerio_app_update_broadcast_action_language
Update a translation of a specific broadcast action, including the body of messages or HTTP requests.

- API: `App API`
- Method/path: `PUT /v1/broadcasts/{broadcast_id}/actions/{action_id}/language/{language}`
- Parameters: `broadcast_id` required, `action_id` required, `language` required
- Body: `payload`

### customerio_app_update_campaign_action
Update the contents of a campaign action, including the body of messages and HTTP requests.

- API: `App API`
- Method/path: `PUT /v1/campaigns/{campaign_id}/actions/{action_id}`
- Parameters: `campaign_id` required, `action_id` required
- Body: `payload`

### customerio_app_update_campaign_action_translation
Update the contents of a language variant of a campaign action, including the body of the messages and HTTP requests.

- API: `App API`
- Method/path: `PUT /v1/campaigns/{campaign_id}/actions/{action_id}/language/{language}`
- Parameters: `campaign_id` required, `action_id` required, `language` required
- Body: `payload`

### customerio_app_update_collection
Update the name or replace the contents of a collection.

- API: `App API`
- Method/path: `PUT /v1/collections/{collection_id}`
- Parameters: `collection_id` required
- Body: `payload`

### customerio_app_update_collection_contents
Replace the contents of a collection (the data from when you created or updated a collection).

- API: `App API`
- Method/path: `PUT /v1/collections/{collection_id}/content`
- Parameters: `collection_id` required
- Body: `payload`

### customerio_app_update_component
Update part of a component: its name, tag, folder, or content.

- API: `App API`
- Method/path: `PUT /v1/design_studio/components/{id}`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_update_email
Update part of an email: an email's name, template status, folder, content, envelope, or transformers.

- API: `App API`
- Method/path: `PUT /v1/design_studio/emails/{id}`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_update_email_translation
Update part of an email translation: the content, envelope, or transformers for a specific email translation.

- API: `App API`
- Method/path: `PUT /v1/design_studio/emails/{id}/languages/{language}`
- Parameters: `id` required, `language` required
- Body: `payload` required

### customerio_app_update_event_metadata
Events are actions your customers have performed.

- API: `App API`
- Method/path: `POST /v1/data_index/events`
- Parameters: none
- Body: `payload` required

### customerio_app_update_folder
Update part of a folder: the name and/or the folder it belongs to.

- API: `App API`
- Method/path: `PUT /v1/design_studio/folders/{id}`
- Parameters: `id` required
- Body: `payload` required

### customerio_app_update_newsletter_test_translation
Update the translation of a newsletter variant in an A/B test.

- API: `App API`
- Method/path: `PUT /v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}`
- Parameters: `newsletter_id` required, `test_group_id` required, `language` required
- Body: `payload`

### customerio_app_update_newsletter_variant
Update the content of a newsletter: the default message, a test variant in an A/B test group, or a translation.

- API: `App API`
- Method/path: `PUT /v1/newsletters/{newsletter_id}/contents/{content_id}`
- Parameters: `newsletter_id` required, `content_id` required
- Body: `payload`

### customerio_app_update_newsletter_variant_translation
Update the translation of a newsletter variant.

- API: `App API`
- Method/path: `PUT /v1/newsletters/{newsletter_id}/language/{language}`
- Parameters: `newsletter_id` required, `language` required
- Body: `payload`

### customerio_app_update_snippets
In your payload, you'll pass a name and value.

- API: `App API`
- Method/path: `PUT /v1/snippets`
- Parameters: none
- Body: `payload`

### customerio_app_update_transactional
Update the body of a transactional email.

- API: `App API`
- Method/path: `PUT /v1/transactional/{transactional_id}/content/{content_id}`
- Parameters: `transactional_id` required, `content_id` required
- Body: `payload`

### customerio_app_update_transactional_variant
Update the body and other data of a specific language variant for a transactional message.

- API: `App API`
- Method/path: `PUT /v1/transactional/{transactional_id}/language/{language}`
- Parameters: `transactional_id` required, `language` required
- Body: `payload`

### customerio_app_update_webhook
Update the configuration of a reporting webhook.

- API: `App API`
- Method/path: `PUT /v1/reporting_webhooks/{webhook_id}`
- Parameters: `webhook_id` required
- Body: `payload`

### customerio_pipelines_alias
*You **only** need to use this method to support a few select destinations like Mixpanel.* The alias method reconciles identifiers in systems that don't automatically handle identity changeslike when a person graduates f.

- API: `Pipelines API`
- Method/path: `POST /alias`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_batch
The batch method helps you send an array of identify, group, track, page and/or screen requests in a single call, so you don't have to send multiple requests.

- API: `Pipelines API`
- Method/path: `POST /batch`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_group
Group calls add people to a group.

- API: `Pipelines API`
- Method/path: `POST /group`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_identify
Identifies a person and assigns traits to them.

- API: `Pipelines API`
- Method/path: `POST /identify`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_page
Sends a page view event.

- API: `Pipelines API`
- Method/path: `POST /page`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_screen
Sends a screen view event for mobile devices.

- API: `Pipelines API`
- Method/path: `POST /screen`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_pipelines_track
Send an event associated with a person.

- API: `Pipelines API`
- Method/path: `POST /track`
- Parameters: `x_strict_mode`
- Body: `payload`

### customerio_track_add_device
Customers can have more than one device.

- API: `Track API`
- Method/path: `PUT /api/v1/customers/{identifier}/devices`
- Parameters: `identifier`
- Body: `payload`

### customerio_track_add_to_segment
Add people to a manual segment by ID.

- API: `Track API`
- Method/path: `POST /api/v1/segments/{segment_id}/add_customers`
- Parameters: `segment_id`
- Body: `payload`

### customerio_track_batch
This endpoint lets you batch requests for different people and objects in a single request.

- API: `Track API`
- Method/path: `POST /api/v2/batch`
- Parameters: none
- Body: `payload`

### customerio_track_delete
Deleting a customer removes them, and all of their information, from Customer.io.

- API: `Track API`
- Method/path: `DELETE /api/v1/customers/{identifier}`
- Parameters: `identifier`

### customerio_track_delete_device
Remove a device from a customer profile.

- API: `Track API`
- Method/path: `DELETE /api/v1/customers/{identifier}/devices/{device_id}`
- Parameters: `identifier`, `device_id`

### customerio_track_entity
This endpoint lets you create, update, or delete a single person or objectincluding managing relationships between objects and people.

- API: `Track API`
- Method/path: `POST /api/v2/entity`
- Parameters: none
- Body: `payload`

### customerio_track_get_region
This endpoint returns the appropriate region and URL for your Track API credentials.

- API: `Track API`
- Method/path: `GET /api/v1/accounts/region`
- Parameters: none

### customerio_track_identify
Adds or updates a person.

- API: `Track API`
- Method/path: `PUT /api/v1/customers/{identifier}`
- Parameters: `identifier`
- Body: `payload`

### customerio_track_merge
Merge two customer profiles together.

- API: `Track API`
- Method/path: `POST /api/v1/merge_customers`
- Parameters: none
- Body: `payload`

### customerio_track_metrics
This endpoint helps you report metrics from channels that aren't native to Customer.io or don't rely on our SDKs.

- API: `Track API`
- Method/path: `POST /api/v1/metrics`
- Parameters: none
- Body: `payload`

### customerio_track_push_metrics
While this endpoint still works, you should take advantage of our .

- API: `Track API`
- Method/path: `POST /api/v1/push/events`
- Parameters: none
- Body: `payload`

### customerio_track_remove_from_segment
You can remove users from a manual segment by ID.

- API: `Track API`
- Method/path: `POST /api/v1/segments/{segment_id}/remove_customers`
- Parameters: `segment_id`
- Body: `payload`

### customerio_track_submit_form
Submit a form response.

- API: `Track API`
- Method/path: `POST /api/v1/forms/{form_id}/submit`
- Parameters: `form_id` required
- Body: `payload`

### customerio_track_suppress
Delete a customer profile and prevent the person's identifier(s) from being re-added to your workspace.

- API: `Track API`
- Method/path: `POST /api/v1/customers/{identifier}/suppress`
- Parameters: `identifier`

### customerio_track_track
Send an event associated with a person, referenced by the identifier in the path.

- API: `Track API`
- Method/path: `POST /api/v1/customers/{identifier}/events`
- Parameters: `identifier`
- Body: `payload`

### customerio_track_track_anonymous
An anonymous event represents a person you haven't identified yet.

- API: `Track API`
- Method/path: `POST /api/v1/events`
- Parameters: none
- Body: `payload`

### customerio_track_unsubscribe
This endpoint lets you set a global unsubscribed status outside of the subscription pathways native to Customer.io.

- API: `Track API`
- Method/path: `POST /unsubscribe/{delivery_id}`
- Parameters: `delivery_id`
- Body: `payload`

### customerio_track_unsuppress
Unsuppressing a profile allows you to add the customer back to Customer.io.

- API: `Track API`
- Method/path: `POST /api/v1/customers/{identifier}/unsuppress`
- Parameters: `identifier`

## Example

```lua
local person = app.integrations.customerio.track_identify({
  identifier = "user_123",
  payload = { email = "ada@example.test", plan = "pro" }
})

local campaigns = app.integrations.customerio.app_list_campaigns({ limit = 20 })
```