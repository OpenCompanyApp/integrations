# Integration: Crisp

Crisp REST API integration for Laravel and AI agents. The package exposes the official `node-crisp-api` REST method surface for conversations, people, campaigns, helpdesk, operators, visitors, plugins, plans, media, and bucket URLs.

## Source Coverage

The operation catalog is generated from the official Crisp Node wrapper (`crisp-api` 10.9.3), whose README states that it implements the REST API reference revision dated 29/01/2026.

## Installation

```bash
composer require opencompanyapp/integration-crisp
```

## Configuration

```php
'crisp' => [
    'identifier' => env('CRISP_TOKEN_IDENTIFIER'),
    'key' => env('CRISP_TOKEN_KEY'),
    'tier' => env('CRISP_TOKEN_TIER', 'plugin'),
    'website_id' => env('CRISP_WEBSITE_ID'),
    'url' => env('CRISP_URL', 'https://api.crisp.chat'),
],
```

Crisp authenticates with HTTP Basic using token `identifier:key` and requires the `X-Crisp-Tier` header (`user`, `website`, or `plugin`). The default `website_id` is used only when a website-scoped tool omits `website_id`.

## Tools

This package exposes 226 official Crisp REST methods. First 80 operations:

| `crisp_generate_bucket_url` | write | POST `/v1/bucket/url/generate` |
| `crisp_list_animation_medias` | read | GET `/v1/media/animation/list/{pageNumber}` |
| `crisp_plan_subscription_list_all_active_subscriptions` | read | GET `/v1/plans/subscription` |
| `crisp_get_plan_subscription_for_website` | read | GET `/v1/plans/subscription/{websiteID}` |
| `crisp_subscribe_website_to_plan` | write | POST `/v1/plans/subscription/{websiteID}` |
| `crisp_unsubscribe_plan_from_website` | write | DELETE `/v1/plans/subscription/{websiteID}` |
| `crisp_change_bill_period_for_website_plan_subscription` | write | PATCH `/v1/plans/subscription/{websiteID}/bill/period` |
| `crisp_check_coupon_availability_for_website_plan_subscription` | read | GET `/v1/plans/subscription/{websiteID}/coupon` |
| `crisp_redeem_coupon_for_website_plan_subscription` | write | PATCH `/v1/plans/subscription/{websiteID}/coupon` |
| `crisp_get_connect_account` | read | GET `/v1/plugin/connect/account` |
| `crisp_check_connect_session_validity` | read | HEAD `/v1/plugin/connect/session` |
| `crisp_list_all_connect_websites` | read | GET `/v1/plugin/connect/websites/all/{pageNumber}` |
| `crisp_list_connect_websites_since` | read | GET `/v1/plugin/connect/websites/since` |
| `crisp_get_connect_endpoints` | read | GET `/v1/plugin/connect/endpoints` |
| `crisp_plugin_subscription_list_all_active_subscriptions` | read | GET `/v1/plugins/subscription` |
| `crisp_list_subscriptions_for_website` | read | GET `/v1/plugins/subscription/{websiteID}` |
| `crisp_get_subscription_details` | read | GET `/v1/plugins/subscription/{websiteID}/{pluginID}` |
| `crisp_subscribe_website_to_plugin` | write | POST `/v1/plugins/subscription/{websiteID}` |
| `crisp_unsubscribe_plugin_from_website` | write | DELETE `/v1/plugins/subscription/{websiteID}/{pluginID}` |
| `crisp_get_subscription_settings` | read | GET `/v1/plugins/subscription/{websiteID}/{pluginID}/settings` |
| `crisp_save_subscription_settings` | write | PUT `/v1/plugins/subscription/{websiteID}/{pluginID}/settings` |
| `crisp_update_subscription_settings` | write | PATCH `/v1/plugins/subscription/{websiteID}/{pluginID}/settings` |
| `crisp_get_plugin_usage_bills` | read | GET `/v1/plugins/subscription/{websiteID}/{pluginID}/bill/usage` |
| `crisp_report_plugin_usage_to_bill` | write | POST `/v1/plugins/subscription/{websiteID}/{pluginID}/bill/usage` |
| `crisp_get_plugin_attest_provenance` | read | GET `/v1/plugins/subscription/{websiteID}/{pluginID}/attest/provenance` |
| `crisp_forward_plugin_payload_to_channel` | write | POST `/v1/plugins/subscription/{websiteID}/{pluginID}/channel` |
| `crisp_dispatch_plugin_event` | write | POST `/v1/plugins/subscription/{websiteID}/{pluginID}/event` |
| `crisp_generate_analytics` | write | POST `/v1/website/{websiteID}/analytics/generate` |
| `crisp_get_website_availability_status` | read | GET `/v1/website/{websiteID}/availability/status` |
| `crisp_list_website_operator_availabilities` | read | GET `/v1/website/{websiteID}/availability/operators` |
| `crisp_check_website_exists` | read | HEAD `/v1/website` |
| `crisp_create_website` | write | POST `/v1/website` |
| `crisp_get_website` | read | GET `/v1/website/{websiteID}` |
| `crisp_delete_website` | write | DELETE `/v1/website/{websiteID}` |
| `crisp_abort_website_deletion` | write | DELETE `/v1/website/{websiteID}/expunge` |
| `crisp_batch_resolve_conversations` | write | PATCH `/v1/website/{websiteID}/batch/resolve` |
| `crisp_batch_read_conversations` | write | PATCH `/v1/website/{websiteID}/batch/read` |
| `crisp_batch_remove_conversations` | write | PATCH `/v1/website/{websiteID}/batch/remove` |
| `crisp_batch_remove_people` | write | PATCH `/v1/website/{websiteID}/batch/remove` |
| `crisp_list_campaigns` | read | GET `/v1/website/{websiteID}/campaigns/list/{pageNumber}` |
| `crisp_list_campaign_tags` | read | GET `/v1/website/{websiteID}/campaigns/tags` |
| `crisp_list_campaign_templates` | read | GET `/v1/website/{websiteID}/campaigns/templates/{pageNumber}` |
| `crisp_create_new_campaign_template` | write | POST `/v1/website/{websiteID}/campaigns/template` |
| `crisp_check_campaign_template_exists` | read | HEAD `/v1/website/{websiteID}/campaigns/template/{templateID}` |
| `crisp_get_campaign_template` | read | GET `/v1/website/{websiteID}/campaigns/template/{templateID}` |
| `crisp_save_campaign_template` | write | PUT `/v1/website/{websiteID}/campaigns/template/{templateID}` |
| `crisp_update_campaign_template` | write | PATCH `/v1/website/{websiteID}/campaigns/template/{templateID}` |
| `crisp_remove_campaign_template` | write | DELETE `/v1/website/{websiteID}/campaigns/template/{templateID}` |
| `crisp_create_new_campaign` | write | POST `/v1/website/{websiteID}/campaign` |
| `crisp_check_campaign_exists` | read | HEAD `/v1/website/{websiteID}/campaign/{campaignID}` |
| `crisp_get_campaign` | read | GET `/v1/website/{websiteID}/campaign/{campaignID}` |
| `crisp_save_campaign` | write | PUT `/v1/website/{websiteID}/campaign/{campaignID}` |
| `crisp_update_campaign` | write | PATCH `/v1/website/{websiteID}/campaign/{campaignID}` |
| `crisp_remove_campaign` | write | DELETE `/v1/website/{websiteID}/campaign/{campaignID}` |
| `crisp_dispatch_campaign` | write | POST `/v1/website/{websiteID}/campaign/{campaignID}/dispatch` |
| `crisp_resume_campaign` | write | POST `/v1/website/{websiteID}/campaign/{campaignID}/resume` |
| `crisp_pause_campaign` | write | POST `/v1/website/{websiteID}/campaign/{campaignID}/pause` |
| `crisp_test_campaign` | write | POST `/v1/website/{websiteID}/campaign/{campaignID}/test` |
| `crisp_list_campaign_recipients` | read | GET `/v1/website/{websiteID}/campaign/{campaignID}/recipients/{pageNumber}` |
| `crisp_list_campaign_statistics` | read | GET `/v1/website/{websiteID}/campaign/{campaignID}/statistics/{action}/{pageNumber}` |
| `crisp_list_conversations` | read | GET `/v1/website/{websiteID}/conversations/{pageNumber}` |
| `crisp_list_suggested_conversation_segments` | read | GET `/v1/website/{websiteID}/conversations/suggest/segments/{pageNumber}` |
| `crisp_delete_suggested_conversation_segment` | write | DELETE `/v1/website/{websiteID}/conversations/suggest/segment` |
| `crisp_list_suggested_conversation_data_keys` | read | GET `/v1/website/{websiteID}/conversations/suggest/data/{pageNumber}` |
| `crisp_delete_suggested_conversation_data_key` | write | DELETE `/v1/website/{websiteID}/conversations/suggest/data` |
| `crisp_list_spam_conversations` | read | GET `/v1/website/{websiteID}/conversations/spams/{pageNumber}` |
| `crisp_resolve_spam_conversation_content` | read | GET `/v1/website/{websiteID}/conversations/spam/{spamID}/content` |
| `crisp_submit_spam_conversation_decision` | write | POST `/v1/website/{websiteID}/conversations/spam/{spamID}/decision` |
| `crisp_create_new_conversation` | write | POST `/v1/website/{websiteID}/conversation` |
| `crisp_check_conversation_exists` | read | HEAD `/v1/website/{websiteID}/conversation/{sessionID}` |
| `crisp_get_conversation` | read | GET `/v1/website/{websiteID}/conversation/{sessionID}` |
| `crisp_remove_conversation` | write | DELETE `/v1/website/{websiteID}/conversation/{sessionID}` |
| `crisp_initiate_conversation_with_existing_session` | write | POST `/v1/website/{websiteID}/conversation/{sessionID}/initiate` |
| `crisp_get_messages_in_conversation` | read | GET `/v1/website/{websiteID}/conversation/{sessionID}/messages` |
| `crisp_send_message_in_conversation` | write | POST `/v1/website/{websiteID}/conversation/{sessionID}/message` |
| `crisp_get_message_in_conversation` | read | GET `/v1/website/{websiteID}/conversation/{sessionID}/message/{fingerprint}` |
| `crisp_update_message_in_conversation` | write | PATCH `/v1/website/{websiteID}/conversation/{sessionID}/message/{fingerprint}` |
| `crisp_remove_message_in_conversation` | write | DELETE `/v1/website/{websiteID}/conversation/{sessionID}/message/{fingerprint}` |
| `crisp_compose_message_in_conversation` | write | PATCH `/v1/website/{websiteID}/conversation/{sessionID}/compose` |
| `crisp_mark_messages_read_in_conversation` | write | PATCH `/v1/website/{websiteID}/conversation/{sessionID}/read` |

All tools accept normalized snake_case arguments. Path, query, and body fields are mapped back to the official Crisp method fields before the request is sent. For complex write operations, pass the documented JSON body as `payload`.
