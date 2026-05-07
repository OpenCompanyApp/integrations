# Integration: VBOUT

> VBOUT integration for OpenCompany agents and Laravel hosts. It exposes the official VBOUT REST API surface for email marketing, contacts, social media, users, goals, webhooks, settings, automation templates, pipeline guides, and AI chatbot templates.

## Installation

```console
composer require opencompanyapp/integration-vbout
```

Laravel auto-discovers the service provider.

## Configuration

This integration requires a VBOUT API user key. In VBOUT, copy it from Settings > API Integrations > API User Key.

```php
return [
    'vbout' => [
        'api_key' => env('VBOUT_API_KEY'),
        'url' => env('VBOUT_URL', 'https://api.vbout.com/1'),
    ],
];
```

## Available Tools

| `vbout_get_current_user` | read | Get Current User |
| `vbout_social_media_channels` | read | Social Media Channels |
| `vbout_social_media_calendar` | read | Social Media Calendar |
| `vbout_social_media_stats` | read | Social Media Stats |
| `vbout_social_media_get_post` | read | Social Media Post |
| `vbout_social_media_add_post` | write | Social Media Add Post |
| `vbout_social_media_edit_post` | write | Social Media Edit Post |
| `vbout_social_media_delete_post` | write | Social Media Delete Post |
| `vbout_list_campaigns` | read | List Campaigns |
| `vbout_get_campaign` | read | Get Campaign |
| `vbout_email_marketing_stats` | read | Email Marketing Stats |
| `vbout_email_marketing_add_campaign` | write | Email Marketing Add Campaign |
| `vbout_email_marketing_edit_campaign` | write | Email Marketing Edit Campaign |
| `vbout_email_marketing_delete_campaign` | write | Email Marketing Delete Campaign |
| `vbout_list_contacts` | read | List Contacts |
| `vbout_email_marketing_get_contacts_by_phone_number` | read | Email Marketing Contacts By Phone Number |
| `vbout_email_marketing_get_contact_by_email` | read | Email Marketing Contact By Email |
| `vbout_get_contact` | read | Get Contact |
| `vbout_create_contact` | write | Create Contact |
| `vbout_email_marketing_edit_contact` | write | Email Marketing Edit Contact |
| `vbout_email_marketing_sync_contact` | write | Email Marketing Sync Contact |
| `vbout_email_marketing_delete_contact` | write | Email Marketing Delete Contact |
| `vbout_email_marketing_move_contact` | write | Email Marketing Move Contact |
| `vbout_email_marketing_get_contact_timeline` | read | Email Marketing Contact Timeline |
| `vbout_email_marketing_get_contact_timeline_by_email_address` | read | Email Marketing Contact Timeline By Email Address |
| `vbout_email_marketing_get_audiences` | read | Email Marketing Audiences |
| `vbout_email_marketing_get_lists` | read | Email Marketing Lists |
| `vbout_email_marketing_get_list` | read | Email Marketing List |
| `vbout_email_marketing_add_list` | write | Email Marketing Add List |
| `vbout_email_marketing_editlist` | write | Email Marketing Edit List |
| `vbout_email_marketing_delete_list` | write | Email Marketing Delete List |
| `vbout_email_marketing_add_activity` | write | Email Marketing Add Activity |
| `vbout_email_marketing_add_tag` | write | Email Marketing Add Tag |
| `vbout_email_marketing_remove_tag` | write | Email Marketing Remove Tag |
| `vbout_email_marketing_get_coupon` | read | Email Marketing Coupon |
| `vbout_user_lists` | read | User Lists |
| `vbout_user_managers` | read | User Managers |
| `vbout_user_status` | write | User Status |
| `vbout_user_add` | write | User Add |
| `vbout_user_edit` | write | User Edit |
| `vbout_user_delete` | write | User Delete |
| `vbout_user_groups` | read | User Groups |
| `vbout_user_group_delete` | write | User Group Delete |
| `vbout_user_group_status` | read | User Group Status |
| `vbout_goal_lists` | read | Goal Lists |
| `vbout_goal_list_by_domain` | read | Goal List By Domain |
| `vbout_goal_show` | read | Goal Show |
| `vbout_goal_add` | write | Goal Add |
| `vbout_goal_edit` | write | Goal Edit |
| `vbout_goal_delete` | write | Goal Delete |
| `vbout_web_hook_lists` | read | Web Hook lists |
| `vbout_webhook_show` | read | Webhook Show |
| `vbout_webhook_add` | write | Webhook Add |
| `vbout_webhook_edit` | write | Webhook Edit |
| `vbout_webhook_delete` | write | Webhook Delete |
| `vbout_register_create_account` | write | Register Create Account |
| `vbout_account_get_sub_account_auto_login` | write | Account Subscriber Account Auto Login |
| `vbout_settings_custom_shortcodes` | read | Settings Custom Short codes |
| `vbout_settings_add_custom_shortcode` | write | Settings Add Custom Short Code |
| `vbout_settings_edit_custom_short_code` | write | Settings Edit Custom Short Code |
| `vbout_settings_delete_custom_shortcode` | write | Settings Delete Custom Short Code |
| `vbout_email_marketing_get_email_templates` | read | Email Marketing Get Email Templates |
| `vbout_automation_get_guides` | read | Automation Get Guides |
| `vbout_automation_create_automation_from_guide` | write | Automation Create Automation From Guide |
| `vbout_pipeline_get_board_guide_categories` | read | Pipeline Get Board Guide Categories |
| `vbout_pipeline_get_board_guides` | read | Pipeline Get Board Guides |
| `vbout_pipeline_create_board_from_guide` | write | Pipeline Create Board From Guide |
| `vbout_aichatbot_aichatbottemplates` | read | AIchatbot aichatbottemplates |
| `vbout_aichatbot_categories` | read | AIchatbot categories |
| `vbout_aichatbot_tags` | read | AIchatbot tags |
| `vbout_aichatbot_copy` | write | AIchatbot copy |

## Notes

- The integration is generated from VBOUT's official OpenAPI document at `https://developers.vbout.com/scripts/openapi.json`.
- VBOUT authenticates with the `key` query parameter.
- Parameter names are normalized to `snake_case` for agents while the service sends VBOUT's original parameter names.

## License

MIT - see [LICENSE](LICENSE).