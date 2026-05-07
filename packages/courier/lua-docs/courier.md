# Courier Integration

Namespace: `app.integrations.courier`.

This integration follows the official Courier API reference linked from `https://www.courier.com/docs/llms.txt`. Use top-level snake_case arguments for path and query parameters. Use `payload` for JSON request bodies.

Important behavior notes from Courier docs: use profile merge operations for partial profile updates, use profile replace only for full replacement, and run bulk sends as create job, add users, then run job.

## Tools

### courier_audiences_delete
Deletes the specified audience.

- Method/path: `DELETE /audiences/{audience_id}`
- Parameters: `audience_id` required

### courier_audiences_get
Returns the specified audience by id.

- Method/path: `GET /audiences/{audience_id}`
- Parameters: `audience_id` required

### courier_audiences_list_audiences
Get the audiences associated with the authorization token.

- Method/path: `GET /audiences`
- Parameters: `cursor`

### courier_audiences_list_members
Get list of members of an audience.

- Method/path: `GET /audiences/{audience_id}/members`
- Parameters: `audience_id` required, `cursor`

### courier_audiences_update
Creates or updates audience.

- Method/path: `PUT /audiences/{audience_id}`
- Parameters: `audience_id` required
- Body: `payload` required

### courier_audit_events_get
Fetch a specific audit event by ID.

- Method/path: `GET /audit-events/{audit-event-id}`
- Parameters: `audit_event_id` required

### courier_audit_events_list
Fetch the list of audit events.

- Method/path: `GET /audit-events`
- Parameters: `cursor`

### courier_auth_tokens_issue_token
Returns a new access token.

- Method/path: `POST /auth/issue-token`
- Parameters: none
- Body: `payload` required

### courier_automations_invoke_ad_hoc_automation
Invoke an ad hoc automation run.

- Method/path: `POST /automations/invoke`
- Parameters: none
- Body: `payload` required

### courier_automations_invoke_automation_template
Invoke an automation run from an automation template.

- Method/path: `POST /automations/{templateId}/invoke`
- Parameters: `template_id` required
- Body: `payload` required

### courier_automations_list
Get the list of automations.

- Method/path: `GET /automations`
- Parameters: `cursor`, `version`

### courier_brands_create
Create a new brand.

- Method/path: `POST /brands`
- Parameters: none
- Body: `payload` required

### courier_brands_delete
Delete a brand by brand ID.

- Method/path: `DELETE /brands/{brand_id}`
- Parameters: `brand_id` required

### courier_brands_get
Fetch a specific brand by brand ID.

- Method/path: `GET /brands/{brand_id}`
- Parameters: `brand_id` required

### courier_brands_list
Get the list of brands.

- Method/path: `GET /brands`
- Parameters: `cursor`

### courier_brands_replace
Replace an existing brand with the supplied values.

- Method/path: `PUT /brands/{brand_id}`
- Parameters: `brand_id` required
- Body: `payload` required

### courier_bulk_create_job
Creates a new bulk job for sending messages to multiple recipients.

- Method/path: `POST /bulk`
- Parameters: none
- Body: `payload` required

### courier_bulk_get_job
Get a bulk job.

- Method/path: `GET /bulk/{job_id}`
- Parameters: `job_id` required

### courier_bulk_get_users
Get Bulk Job Users.

- Method/path: `GET /bulk/{job_id}/users`
- Parameters: `job_id` required, `cursor`

### courier_bulk_ingest_users
Ingest user data into a Bulk Job.

- Method/path: `POST /bulk/{job_id}`
- Parameters: `job_id` required
- Body: `payload` required

### courier_bulk_run_job
Run a bulk job.

- Method/path: `POST /bulk/{job_id}/run`
- Parameters: `job_id` required

### courier_inbound_track
Courier Track Event.

- Method/path: `POST /inbound/courier`
- Parameters: none
- Body: `payload` required

### courier_journeys_invoke
Invoke a journey run from a journey template.

- Method/path: `POST /journeys/{templateId}/invoke`
- Parameters: `template_id` required
- Body: `payload` required

### courier_journeys_list
Get the list of journeys.

- Method/path: `GET /journeys`
- Parameters: `cursor`, `version`

### courier_lists_add_subscribers
Subscribes additional users to the list, without modifying existing subscriptions.

- Method/path: `POST /lists/{list_id}/subscriptions`
- Parameters: `list_id` required
- Body: `payload` required

### courier_lists_delete
Delete a list by list ID.

- Method/path: `DELETE /lists/{list_id}`
- Parameters: `list_id` required

### courier_lists_get
Returns a list based on the list ID provided.

- Method/path: `GET /lists/{list_id}`
- Parameters: `list_id` required

### courier_lists_get_subscribers
Get the list's subscriptions.

- Method/path: `GET /lists/{list_id}/subscriptions`
- Parameters: `list_id` required, `cursor`

### courier_lists_list
Returns all of the lists, with the ability to filter based on a pattern.

- Method/path: `GET /lists`
- Parameters: `cursor`, `pattern`

### courier_lists_restore
Restore a previously deleted list.

- Method/path: `PUT /lists/{list_id}/restore`
- Parameters: `list_id` required
- Body: `payload` required

### courier_lists_subscribe
Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).

- Method/path: `PUT /lists/{list_id}/subscriptions/{user_id}`
- Parameters: `list_id` required, `user_id` required
- Body: `payload` required

### courier_lists_unsubscribe
Delete a subscription to a list by list ID and user ID.

- Method/path: `DELETE /lists/{list_id}/subscriptions/{user_id}`
- Parameters: `list_id` required, `user_id` required

### courier_lists_update
Create or replace an existing list with the supplied values.

- Method/path: `PUT /lists/{list_id}`
- Parameters: `list_id` required
- Body: `payload` required

### courier_lists_update_subscribers
Subscribes the users to the list, overwriting existing subscriptions.

- Method/path: `PUT /lists/{list_id}/subscriptions`
- Parameters: `list_id` required
- Body: `payload` required

### courier_messages_archive
Archive message.

- Method/path: `PUT /requests/{request_id}/archive`
- Parameters: `request_id` required

### courier_messages_cancel
Cancel a message that is currently in the process of being delivered.

- Method/path: `POST /messages/{message_id}/cancel`
- Parameters: `message_id` required

### courier_messages_get
Fetch the status of a message you've previously sent.

- Method/path: `GET /messages/{message_id}`
- Parameters: `message_id` required

### courier_messages_get_content
Get message content.

- Method/path: `GET /messages/{message_id}/output`
- Parameters: `message_id` required

### courier_messages_get_history
Fetch the array of events of a message you've previously sent.

- Method/path: `GET /messages/{message_id}/history`
- Parameters: `message_id` required, `type`

### courier_messages_list
Fetch the statuses of messages you've previously sent.

- Method/path: `GET /messages`
- Parameters: `archived`, `cursor`, `event`, `list`, `message_id`, `notification`, `provider`, `recipient`, `status`, `tag`, `tags`, `tenant_id`, `enqueued_after`, `trace_id`

### courier_notifications_archive
Archive a notification template.

- Method/path: `DELETE /notifications/{id}`
- Parameters: `id` required

### courier_notifications_create
Create a notification template.

- Method/path: `POST /notifications`
- Parameters: none
- Body: `payload` required

### courier_notifications_list
List notification templates in your workspace.

- Method/path: `GET /notifications`
- Parameters: `cursor`, `notes`, `event_id`

### courier_notifications_list_versions
List versions of a notification template.

- Method/path: `GET /notifications/{id}/versions`
- Parameters: `id` required, `cursor`, `limit`

### courier_notifications_publish
Publish a notification template.

- Method/path: `POST /notifications/{id}/publish`
- Parameters: `id` required
- Body: `payload`

### courier_notifications_replace
Replace a notification template.

- Method/path: `PUT /notifications/{id}`
- Parameters: `id` required
- Body: `payload` required

### courier_notifications_retrieve
Retrieve a notification template by ID.

- Method/path: `GET /notifications/{id}`
- Parameters: `id` required, `version`

### courier_profiles_create
Merge the supplied values with an existing profile or create a new profile if one doesn't already exist.

- Method/path: `POST /profiles/{user_id}`
- Parameters: `user_id` required
- Body: `payload` required

### courier_profiles_delete
Deletes the specified user profile.

- Method/path: `DELETE /profiles/{user_id}`
- Parameters: `user_id` required

### courier_profiles_delete_list_subscription
Removes all list subscriptions for given user.

- Method/path: `DELETE /profiles/{user_id}/lists`
- Parameters: `user_id` required

### courier_profiles_get
Returns the specified user profile.

- Method/path: `GET /profiles/{user_id}`
- Parameters: `user_id` required

### courier_profiles_get_list_subscriptions
Returns the subscribed lists for a specified user.

- Method/path: `GET /profiles/{user_id}/lists`
- Parameters: `user_id` required, `cursor`

### courier_profiles_merge_profile
Update a profile.

- Method/path: `PATCH /profiles/{user_id}`
- Parameters: `user_id` required
- Body: `payload` required

### courier_profiles_replace
When using PUT, be sure to include all the key-value pairs required by the recipient's profile.

- Method/path: `PUT /profiles/{user_id}`
- Parameters: `user_id` required
- Body: `payload` required

### courier_profiles_subscribe_to_list
Subscribes the given user to one or more lists.

- Method/path: `POST /profiles/{user_id}/lists`
- Parameters: `user_id` required
- Body: `payload` required

### courier_routing_strategies_archive
Archive a routing strategy.

- Method/path: `DELETE /routing-strategies/{id}`
- Parameters: `id` required

### courier_routing_strategies_create
Create a routing strategy.

- Method/path: `POST /routing-strategies`
- Parameters: none
- Body: `payload` required

### courier_routing_strategies_list
List routing strategies in your workspace.

- Method/path: `GET /routing-strategies`
- Parameters: `cursor`, `limit`

### courier_routing_strategies_replace
Replace a routing strategy.

- Method/path: `PUT /routing-strategies/{id}`
- Parameters: `id` required
- Body: `payload` required

### courier_routing_strategies_retrieve
Retrieve a routing strategy by ID.

- Method/path: `GET /routing-strategies/{id}`
- Parameters: `id` required

### courier_send
Send a message to one or more recipients.

- Method/path: `POST /send`
- Parameters: none
- Body: `payload` required

### courier_tenants_create_or_replace
Create or Replace a Tenant.

- Method/path: `PUT /tenants/{tenant_id}`
- Parameters: `tenant_id` required
- Body: `payload` required

### courier_tenants_create_or_replace_default_preferences_for_topic
Create or Replace Default Preferences For Topic.

- Method/path: `PUT /tenants/{tenant_id}/default_preferences/items/{topic_id}`
- Parameters: `tenant_id` required, `topic_id` required
- Body: `payload` required

### courier_tenants_delete
Delete a Tenant.

- Method/path: `DELETE /tenants/{tenant_id}`
- Parameters: `tenant_id` required

### courier_tenants_get
Get a Tenant.

- Method/path: `GET /tenants/{tenant_id}`
- Parameters: `tenant_id` required

### courier_tenants_get_template_by_tenant
Get a Template in Tenant.

- Method/path: `GET /tenants/{tenant_id}/templates/{template_id}`
- Parameters: `tenant_id` required, `template_id` required

### courier_tenants_get_template_list_by_tenant
List Templates in Tenant.

- Method/path: `GET /tenants/{tenant_id}/templates`
- Parameters: `tenant_id` required, `limit`, `cursor`

### courier_tenants_get_template_version
Fetches a specific version of a tenant template.

- Method/path: `GET /tenants/{tenant_id}/templates/{template_id}/versions/{version}`
- Parameters: `tenant_id` required, `template_id` required, `version` required

### courier_tenants_get_users_by_tenant
Get Users in Tenant.

- Method/path: `GET /tenants/{tenant_id}/users`
- Parameters: `tenant_id` required, `limit`, `cursor`

### courier_tenants_list
Get a List of Tenants.

- Method/path: `GET /tenants`
- Parameters: `parent_tenant_id`, `limit`, `cursor`

### courier_tenants_publish_template
Publishes a specific version of a notification template for a tenant.

- Method/path: `POST /tenants/{tenant_id}/templates/{template_id}/publish`
- Parameters: `tenant_id` required, `template_id` required
- Body: `payload`

### courier_tenants_remove_default_preferences_for_topic
Remove Default Preferences For Topic.

- Method/path: `DELETE /tenants/{tenant_id}/default_preferences/items/{topic_id}`
- Parameters: `tenant_id` required, `topic_id` required

### courier_tenants_replace_template
Creates or updates a notification template for a tenant.

- Method/path: `PUT /tenants/{tenant_id}/templates/{template_id}`
- Parameters: `tenant_id` required, `template_id` required
- Body: `payload` required

### courier_translations_get
Get translations by locale.

- Method/path: `GET /translations/{domain}/{locale}`
- Parameters: `domain` required, `locale` required

### courier_translations_update
Update a translation.

- Method/path: `PUT /translations/{domain}/{locale}`
- Parameters: `domain` required, `locale` required
- Body: `payload` required

### courier_users_preferences_get
Fetch user preferences for a specific subscription topic.

- Method/path: `GET /users/{user_id}/preferences/{topic_id}`
- Parameters: `user_id` required, `topic_id` required, `tenant_id`

### courier_users_preferences_list
Fetch all user preferences.

- Method/path: `GET /users/{user_id}/preferences`
- Parameters: `user_id` required, `tenant_id`

### courier_users_preferences_update
Update or Create user preferences for a specific subscription topic.

- Method/path: `PUT /users/{user_id}/preferences/{topic_id}`
- Parameters: `user_id` required, `topic_id` required, `tenant_id`
- Body: `payload` required

### courier_users_tenants_add
This endpoint is used to add a single tenant.

- Method/path: `PUT /users/{user_id}/tenants/{tenant_id}`
- Parameters: `user_id` required, `tenant_id` required
- Body: `payload` required

### courier_users_tenants_add_multiple
This endpoint is used to add a user to multiple tenants in one call.

- Method/path: `PUT /users/{user_id}/tenants`
- Parameters: `user_id` required
- Body: `payload` required

### courier_users_tenants_list
Returns a paginated list of user tenant associations.

- Method/path: `GET /users/{user_id}/tenants`
- Parameters: `user_id` required, `limit`, `cursor`

### courier_users_tenants_remove
Removes a user from the supplied tenant.

- Method/path: `DELETE /users/{user_id}/tenants/{tenant_id}`
- Parameters: `user_id` required, `tenant_id` required

### courier_users_tenants_remove_all
Removes a user from any tenants they may have been associated with.

- Method/path: `DELETE /users/{user_id}/tenants`
- Parameters: `user_id` required

### courier_users_tokens_add
Adds a single token to a user and overwrites a matching existing token.

- Method/path: `PUT /users/{user_id}/tokens/{token}`
- Parameters: `user_id` required, `token` required
- Body: `payload` required

### courier_users_tokens_add_multiple
Adds multiple tokens to a user and overwrites matching existing tokens.

- Method/path: `PUT /users/{user_id}/tokens`
- Parameters: `user_id` required

### courier_users_tokens_delete
Delete User Token.

- Method/path: `DELETE /users/{user_id}/tokens/{token}`
- Parameters: `user_id` required, `token` required

### courier_users_tokens_get
Get single token available for a :token.

- Method/path: `GET /users/{user_id}/tokens/{token}`
- Parameters: `user_id` required, `token` required

### courier_users_tokens_list
Gets all tokens available for a :user_id.

- Method/path: `GET /users/{user_id}/tokens`
- Parameters: `user_id` required

### courier_users_tokens_update
Apply a JSON Patch (RFC 6902) to the specified token.

- Method/path: `PATCH /users/{user_id}/tokens/{token}`
- Parameters: `user_id` required, `token` required
- Body: `payload` required

## Example

```lua
local sent = app.integrations.courier.send({
  payload = {
    message = {
      to = { user_id = "user_123" },
      template = "template_id",
      data = { name = "Ada" }
    }
  }
})

local profile = app.integrations.courier.profiles_create({
  user_id = "user_123",
  payload = { profile = { email = "ada@example.test" } }
})
```