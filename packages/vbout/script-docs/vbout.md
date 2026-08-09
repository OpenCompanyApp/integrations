# VBOUT - JavaScript API Reference

Namespace: `app.integrations.vbout`

This integration follows VBOUT's official OpenAPI document. Responses are returned as VBOUT JSON objects, including endpoint-specific containers such as `response.data`, `contacts`, `campaigns`, `lists`, `channels`, or other service fields when VBOUT provides them. Parameter names below are normalized to `snake_case`; the service maps them back to VBOUT's original query parameter names.

## get_current_user

Call the VBOUT Get Current User endpoint. Authentication: Required Response Formats: XML | JSON Particular endpoint Including All Possible Endpoints' responses

Parameters: none.

```js
var result = app.integrations.vbout.get_current_user({
})
```
## social_media_channels

Call the VBOUT Social Media Channels endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.social_media_channels({
})
```
## social_media_calendar

Call the VBOUT Social Media Calendar endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channels` | string | no | The channels from where the posts are gathered. Possible Values: all / facebook / twitter / linkedin |
| `from` | string | yes | The from date which the reviews are returned. The filter must be date for this parameter to work. Possible Values: (Date) |
| `to` | string | yes | The to date which the reviews are returned. The filter must be date for this parameter to work. Possible Values: (Date) |
| `include_posted` | boolean | no | Include already scheduled posts inside the results. Possible Values: true / false |
| `limit` | number | no | Set your record limit number per page. Possible Values:(Number) |
| `page` | number | no | Set which page you wanna get. Possible Values:(Number) |
| `sort` | string | no | Record Sorting. Possible Values: asc / desc |

```js
var result = app.integrations.vbout.social_media_calendar({
  from: "example",
  to: "example",
})
```
## social_media_stats

Call the VBOUT Social Media Stats endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `channels` | string | no | The channels where the posts are gathered from. Possible values: all / facebook / twitter / linkedin / pinterest |
| `sort` | string | no | Record Sorting. Possible values: asc / desc |

```js
var result = app.integrations.vbout.social_media_stats({
})
```
## social_media_get_post

Call the VBOUT Social Media Post endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The id of the post Possible values: (ID) |
| `channel` | string | yes | The channel where the post is created. Possible values: facebook / twitter / linkedin |

```js
var result = app.integrations.vbout.social_media_get_post({
  id: 123,
  channel: "example",
})
```
## social_media_add_post

Call the VBOUT Social Media Add Post endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message` | string | yes | The post message to be scheduled/sent Possible values:"Text" |
| `channel` | string | yes | The channels which the post will be sent to. Possible values: facebook / twitter / linkedin / pinterest / instagram |
| `channel_id` | integer | yes | The channels which the post will be sent to. Possible values: 1 / 2 / 3 / 4 |
| `photo` | string | no | The photo which will be attached to the post. Possible values: (Link) or (Uploaded Image) |
| `isscheduled` | boolean | no | This flag will make the post to be scheduled for future. Possible values: true / false |
| `scheduled_date` | string | no | Date of the post to be scheduled. Possible values: (Date) |
| `scheduled_hours` | string | no | Time of the post to be scheduled. Possible values: (Time) |
| `scheduled_ampm` | string | no | AMPM of the post to be scheduled. Possible values: AM / PM / am / pm |
| `trackable_links` | boolean | no | Convert all links inside message to short urls. Possible values: true / false |

```js
var result = app.integrations.vbout.social_media_add_post({
  message: "example",
  channel: "example",
  channel_id: 123,
})
```
## social_media_edit_post

Call the VBOUT Social Media Edit Post endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | ID of the post message to be edited. Possible values: (ID) |
| `channel` | string | yes | The channel where the post was scheduled. Possible values: facebook / twitter / linkedin / pinterest / instagram |
| `message` | string | no | The post message to be scheduled/sent. Possible values: (Text) |
| `scheduled_datetime` | string | no | Date/Time of the post to be scheduled Possible values: (Datetime) |

```js
var result = app.integrations.vbout.social_media_edit_post({
  id: 123,
  channel: "example",
})
```
## social_media_delete_post

Call the VBOUT Social Media Delete Post endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | ID of the post message to be deleted. Possible Values:(ID) |
| `channel` | string | no | The channels which the post will be sent to. Possible Values: facebook / twitter / linkedin |

```js
var result = app.integrations.vbout.social_media_delete_post({
  id: 123,
})
```
## list_campaigns

Call the VBOUT List Campaigns endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | yes | The timeline during which the reviews are returned. Possible values: all / sent / scheduled / draft / automation |
| `from` | string | no | The from date which the reviews are returned. The filter must be 'date' for this parameter to work. Possible values: (Date) |
| `to` | string | no | The from date which the reviews are returned. The filter must be 'date' for this parameter to work. Possible values: (Date) |
| `limit` | number | no | Set your record limit number per page. Possible values: (Number) |
| `page` | number | no | Set which page you wanna get. Possible values: (Number) |

```js
var result = app.integrations.vbout.list_campaigns({
  filter: "example",
})
```
## get_campaign

Call the VBOUT Get Campaign endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the campaign to return. Possible Values: (ID) |
| `type` | string | no | The type of the campaign. Possible Values: standard / automated |

```js
var result = app.integrations.vbout.get_campaign({
  id: 123,
})
```
## email_marketing_stats

Call the VBOUT Email Marketing Stats endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the campaign to return. Possible values: (ID) |
| `type` | string | no | The type of the campaign. Possible values: standard / automated |

```js
var result = app.integrations.vbout.email_marketing_stats({
  id: 123,
})
```
## email_marketing_add_campaign

Call the VBOUT Email Marketing Add Campaign endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the campaign. Possible values: (Text) |
| `subject` | string | yes | The subject line for the campaign. Possible values: (Text) |
| `from_email` | string | yes | The from email of the campaign. Possible values: (Email) |
| `from_name` | string | yes | The from name of the campaign. Possible values: (Text) |
| `reply_to` | string | yes | The reply to email of the campaign. Possible values: (Email) |
| `body` | string | yes | Message body. Possible values: (Text) |
| `type` | string | no | The type of the campaign. Possible values: standard / automated |
| `isscheduled` | boolean | no | The flag to schedule the campaign for the future. Possible values: true / false |
| `isdraft` | boolean | no | The flag to set the campaign to draft. Possible values: true / false |
| `scheduled_datetime` | string | no | The date and time to schedule the campaign. Possible values: (Date) |
| `audiences` | integer | no | IDs of audience campaign recipients.(comma separated) Possible values: (IDs) |
| `lists` | integer | no | IDs of list campaign recipients.(comma separated) Possible values: (IDs) |

```js
var result = app.integrations.vbout.email_marketing_add_campaign({
  name: "example",
  subject: "example",
  from_email: "example",
  from_name: "example",
  reply_to: "example",
  body: "example",
})
```
## email_marketing_edit_campaign

Call the VBOUT Email Marketing Edit Campaign endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the campaign. Possible values: (ID) |
| `name` | string | yes | The name of the campaign. Possible values: (Text) |
| `subject` | string | yes | The subject line of the campaign. Possible values: (Text) |
| `body` | string | yes | Message body. Possible values: (Text) |
| `from_email` | string | yes | The from email of the campaign. Possible values: (Text) |
| `from_name` | string | yes | The from name of the campaign. Possible values: (Text) |
| `reply_to` | string | yes | The reply to email of the campaign. Possible values:(Email) |
| `isscheduled` | boolean | no | The flag to schedule the campaign for the future. Possible values: true / false |
| `isdraft` | boolean | no | The flag to set the campaign to draft. Possible values: true / false |
| `scheduled_datetime` | string | no | The date time to schedule the campaign. |
| `audiences` | integer | no | IDs of audience campaign recipients.(comma separated) Possible values: (IDs) |
| `lists` | integer | no | IDs of list campaign recipients.(comma separated) Possible values: (IDs) |
| `type` | string | no | The type of the campaign. Possible values: standard / automated |

```js
var result = app.integrations.vbout.email_marketing_edit_campaign({
  id: 123,
  name: "example",
  subject: "example",
  body: "example",
  from_email: "example",
  from_name: "example",
  reply_to: "example",
})
```
## email_marketing_delete_campaign

Call the VBOUT Email Marketing Delete Campaign endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the campaign to delete. Possible values: (ID) |
| `type` | string | no | The type of the campaign. Possible values: standard / automated |

```js
var result = app.integrations.vbout.email_marketing_delete_campaign({
  id: 123,
})
```
## list_contacts

Call the VBOUT List Contacts endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | integer | yes | The ID of the list to return its contacts. Possible values: (IDs) |

```js
var result = app.integrations.vbout.list_contacts({
  list_id: 123,
})
```
## email_marketing_get_contacts_by_phone_number

Call the VBOUT Email Marketing Contacts By Phone Number endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | integer | yes | The ID of the list to return its contacts. Possible values: (IDs) |

```js
var result = app.integrations.vbout.email_marketing_get_contacts_by_phone_number({
  list_id: 123,
})
```
## email_marketing_get_contact_by_email

Call the VBOUT Email Marketing Contact By Email endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The Email of the contact to return.Possible values: (Email) |
| `list_id` | integer | no | The List id of which this contact does belong to.Possible values:(ID) |

```js
var result = app.integrations.vbout.email_marketing_get_contact_by_email({
  email: "example",
})
```
## get_contact

Call the VBOUT Get Contact endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact to return. Possible values: (ID) |

```js
var result = app.integrations.vbout.get_contact({
  id: 123,
})
```
## create_contact

Call the VBOUT Create Contact endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | yes | The status of the contact. Possible values: (Active / Disactive) |
| `list_id` | integer | yes | The ID of the list to assign this contact to. Possible values: (ID) |
| `email` | string | no | The email of the contact. Possible values: (Email) |
| `ip_address` | string | no | The ip of the contact. Possible values: (IP) |
| `fields` | array | no | The list of custom fields added to a specific list. Possible values: Array('fieldID'=>'fieldValue') Accepted Date Formats: Y-m-d / d-m-Y / m/d/Y |

```js
var result = app.integrations.vbout.create_contact({
  status: "example",
  list_id: 123,
})
```
## email_marketing_edit_contact

Call the VBOUT Email Marketing Edit Contact endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact. Possible values: (ID) |
| `email` | string | no | The email of the contact. Possible values: (Email) |
| `ip_address` | string | no | The ip of the contact. Possible values: (IP) |
| `status` | string | no | The status of the contact. Possible values: (Active / Disactive) |
| `fields` | array | no | The list of custom fields added to a specific list. Possible values: Array('fieldID'=>'fieldValue') Accepted Date Formats: Y-m-d / d-m-Y / m/d/Y |

```js
var result = app.integrations.vbout.email_marketing_edit_contact({
  id: 123,
})
```
## email_marketing_sync_contact

Call the VBOUT Email Marketing Sync Contact endpoint. Authentication: Required Response Formats: XML | JSON Note: All emails having the same email text available in the provided list will be updated if exists (case email is not required).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email of the contact. Possible values: (Email) |
| `list_id` | integer | no | The ID of the list to assign this contact to. Possible values: (ID) |
| `ip_address` | string | no | The ip of the contact. Possible values: (IP) |
| `status` | string | no | The status of the contact. Possible values: (Active / Disactive) |
| `fields` | array | no | The list of custom fields added to a specific list. Possible values: Array('fieldID'=>'fieldValue') Accepted Date Formats: Y-m-d / d-m-Y / m/d/Y |

```js
var result = app.integrations.vbout.email_marketing_sync_contact({
  email: "example",
})
```
## email_marketing_delete_contact

Call the VBOUT Email Marketing Delete Contact endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact to delete. Possible values: (ID) |
| `list_id` | integer | yes | The ID of the list to delete from. Possible values: (ID) |

```js
var result = app.integrations.vbout.email_marketing_delete_contact({
  id: 123,
  list_id: 123,
})
```
## email_marketing_move_contact

Call the VBOUT Email Marketing Move Contact endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact. Possible Values: (ID) |
| `list_id` | integer | yes | The ID of the list to assign this contact to. Possible values: (ID) |
| `sourceid` | integer | yes | The ID of the list to assign this contact to. Possible values: (ID) |

```js
var result = app.integrations.vbout.email_marketing_move_contact({
  id: 123,
  list_id: 123,
  sourceid: 123,
})
```
## email_marketing_get_contact_timeline

Call the VBOUT Email Marketing Contact Timeline endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact to return his timeline activities. Possible values: (ID) |
| `include` | string | no | Comma separated keys to return other details with the timeline activities. Possible values: utm / automated |

```js
var result = app.integrations.vbout.email_marketing_get_contact_timeline({
  id: 123,
})
```
## email_marketing_get_contact_timeline_by_email_address

Call the VBOUT Email Marketing Contact Timeline By Email Address endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address for the contact to return his timeline activities. Possible values: (ID) |
| `include` | string | no | Comma separated keys to return other details with the timeline activities. Possible values: utm / automated |

```js
var result = app.integrations.vbout.email_marketing_get_contact_timeline_by_email_address({
  email: "example",
})
```
## email_marketing_get_audiences

Call the VBOUT Email Marketing Audiences endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.email_marketing_get_audiences({
})
```
## email_marketing_get_lists

Call the VBOUT Email Marketing Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.email_marketing_get_lists({
})
```
## email_marketing_get_list

Call the VBOUT Email Marketing List endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the list to return. Possible values: (ID) |

```js
var result = app.integrations.vbout.email_marketing_get_list({
  id: 123,
})
```
## email_marketing_add_list

Call the VBOUT Email Marketing Add List endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the list. Possible values: (Text) |
| `email_subject` | string | no | The default subscription subject. Possible values: (Text) |
| `reply_to` | string | no | The Reply to email of the list. Possible values: (Email) |
| `from_email` | string | no | The From email of the list. Possible values: (Email) |
| `from_name` | integer | no | The From name of the list. Possible values: (Text) |
| `double_optin` | string | no | Email confirmation required (Double opt-in)? Possible values: 0 / 1 |
| `notify` | string | no | Notify me of new subscribers. Possible values: (Text) |
| `notify_email` | string | no | Notification Email. Possible values: (Email) |
| `success_email` | string | no | Subscription Success Email. Possible values: (Email) |
| `success_message` | string | no | Subscription Success Message. Possible values: (Text) |
| `error_message` | string | no | Subscription Error Message. Possible values: (Text) |
| `confirmation_email` | string | no | Confirmation Email Message. Possible values: (Text) |
| `confirmation_message` | string | no | Confirmation Message. Possible values: (Text) |
| `communications` | string | no | Turn off Communications? (0-No / 1-Yes) Possible values: 0 / 1 |

```js
var result = app.integrations.vbout.email_marketing_add_list({
  name: "example",
})
```
## email_marketing_editlist

Call the VBOUT Email Marketing Edit List endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The id of the list. Possible values: (Number) |
| `name` | string | yes | The name of the list. Possible values: (Text) |
| `email_subject` | string | no | The default subject line of subscription. Possible values: (Text) |
| `reply_to` | string | no | The Reply to email of the list. Possible values: (Email) |
| `from_email` | string | no | The From email of the list. Possible values: (Email) |
| `from_name` | string | no | The From name of the list. Possible values: (Text) |
| `double_optin` | string | no | Email confirmation required (Double opt-in)?. Possible values: 0 / 1 |
| `notify` | string | no | Notify me of new subscribers. Possible values: (Text) |
| `notify_email` | string | no | Notification Email. Possible values:(Email) |
| `success_email` | string | no | Subscription Success Email. Possible values: (Text) |
| `success_message` | string | no | Subscription Success Message. Possible values: (Text) |
| `error_message` | string | no | Subscription Error Message. Possible values: (Text) |
| `confirmation_email` | string | no | Confirmation Email Message. Possible values: (Text) |
| `confirmation_email_message` | string | no | Confirmation Message. Possible values: (Text) |
| `communications` | string | no | Turn off Communications? (0-No / 1-Yes) Possible values: 0 / 1 |

```js
var result = app.integrations.vbout.email_marketing_editlist({
  id: 123,
  name: "example",
})
```
## email_marketing_delete_list

Call the VBOUT Email Marketing Delete List endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the list to delete. Possible values: (ID) |

```js
var result = app.integrations.vbout.email_marketing_delete_list({
  id: 123,
})
```
## email_marketing_add_activity

Call the VBOUT Email Marketing Add Activity endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The id of the contact. Possible values: (ID) |
| `description` | string | yes | The description of the activity. Possible values: (Text) |
| `datetime` | string | yes | The date and time to activity. Possible values: (DateTime) |

```js
var result = app.integrations.vbout.email_marketing_add_activity({
  id: 123,
  description: "example",
  datetime: "example",
})
```
## email_marketing_add_tag

Call the VBOUT Email Marketing Add Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | no | The id of the contact. Possible values: (ID) |
| `email` | string | yes | The email of the contact. Possible values: (text) |
| `tagname` | string | yes | Tag(s) to be added. Possible values: (Text) |

```js
var result = app.integrations.vbout.email_marketing_add_tag({
  email: "example",
  tagname: "example",
})
```
## email_marketing_remove_tag

Call the VBOUT Email Marketing Remove Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | no | The id of the contact. Possible values: (ID) |
| `email` | string | yes | The email of the contact. Possible values: (text) |
| `tagname` | string | yes | Tag(s) to be added. Possible values: (text) |

```js
var result = app.integrations.vbout.email_marketing_remove_tag({
  email: "example",
  tagname: "example",
})
```
## email_marketing_get_coupon

Call the VBOUT Email Marketing Coupon endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email of the contact to return coupons of. Possible values: (Email) |
| `campaign_id` | string | no | The ID of the campaign containing coupons. Possible values: (Campaign id) |

```js
var result = app.integrations.vbout.email_marketing_get_coupon({
  email: "example",
})
```
## user_lists

Call the VBOUT User Lists endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `business_id` | string | no | The ID of the business if it's an agency to return its contacts. Possible values: (ID) |

```js
var result = app.integrations.vbout.user_lists({
})
```
## user_managers

Call the VBOUT User Managers endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.user_managers({
})
```
## user_status

Call the VBOUT User Status endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the user to change status. Possible values: (ID) |
| `type` | string | yes | The type of the user. Possible values: user / manager |
| `status` | string | yes | The status of the user. Possible values: enable / disable |

```js
var result = app.integrations.vbout.user_status({
  id: 123,
  type: "example",
  status: "example",
})
```
## user_add

Call the VBOUT User Add endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fullname` | string | yes | The name of the user. Possible values: (Text) |
| `username` | string | yes | The username of the user. Possible values: (Email Address) |
| `password` | string | yes | The password of the user. Possible values: (Text) |
| `type` | string | yes | The type of the user. Possible values: user / manager |
| `group` | string | no | The group id of the user. Possible values: (ID) |
| `permissions` | string | no | Optional Required: if no group is selected. The permissions of the user. (comma-separated values) Possible values: all / reputation_center / foursquare / pinterest / social_media / email_marketing / master_reporting / users_and_workflow / user_groups / smart_calendar / site_builder / asset_manager / task_manager / notes / social_tracker / google_analytics / email_automation_workflow / live_hashtags / goal_conversion_tracking / expedia_affiliate_network / behavioral_webhooks / lead_scoring / landingpages / sms_automation / heatmap / email_test / salesforce_sync / browser_push / hubspot_sync / zoho_sync / pipeline_manager / campaign_groups / webinars / content_bank / insightly_sync / ftp_sync / simplifi_reports / custom_smtp / call_center |

```js
var result = app.integrations.vbout.user_add({
  fullname: "example",
  username: "example",
  password: "example",
  type: "example",
})
```
## user_edit

Call the VBOUT User Edit endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the user. Possible values: (ID) |
| `fullname` | string | yes | The name of the user. Possible values: (Text) |
| `username` | string | yes | The username of the user. Possible values: (Text) |
| `type` | string | no | The type of the user. Possible values: (user / manager) |
| `password` | string | no | The password of the user. Possible values: (Text) |
| `group` | string | no | The group id of the user. Possible values: (ID) |
| `permissions` | string | no | Optional Required: if no group is selected. The permissions of the user. (comma-separated values) Possible values: all / reputation_center / foursquare / pinterest / social_media / email_marketing / master_reporting / users_and_workflow / user_groups / smart_calendar / site_builder / asset_manager / task_manager / notes / social_tracker / google_analytics / email_automation_workflow / live_hashtags / goal_conversion_tracking / expedia_affiliate_network / behavioral_webhooks / lead_scoring / landingpages / sms_automation / heatmap / email_test / salesforce_sync / browser_push / hubspot_sync / zoho_sync / pipeline_manager / campaign_groups / webinars / content_bank / insightly_sync / ftp_sync / simplifi_reports / custom_smtp / call_center |

```js
var result = app.integrations.vbout.user_edit({
  id: 123,
  fullname: "example",
  username: "example",
})
```
## user_delete

Call the VBOUT User Delete endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the user to delete. Possible values: (ID) |
| `type` | string | yes | The type of the user. Possible values: user / manager |

```js
var result = app.integrations.vbout.user_delete({
  id: "example",
  type: "example",
})
```
## user_groups

Call the VBOUT User Groups endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.user_groups({
})
```
## user_group_delete

Call the VBOUT User Group Delete endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the group to delete. Possible values: (ID) |

```js
var result = app.integrations.vbout.user_group_delete({
  id: "example",
})
```
## user_group_status

Call the VBOUT User Group Status endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the group to change status. Possible values: (ID) |
| `status` | string | yes | The status of the group. Possible values: enable / disable |

```js
var result = app.integrations.vbout.user_group_status({
  id: "example",
  status: "example",
})
```
## goal_lists

Call the VBOUT Goal Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.goal_lists({
})
```
## goal_list_by_domain

Call the VBOUT Goal List By Domain endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | string | yes | The ID of the domain to return its goals. Possible values: (ID) |

```js
var result = app.integrations.vbout.goal_list_by_domain({
  domain_id: "example",
})
```
## goal_show

Call the VBOUT Goal Show endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the goal. Possible values: (ID) |

```js
var result = app.integrations.vbout.goal_show({
  id: "example",
})
```
## goal_add

Call the VBOUT Goal Add endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain_id` | integer | yes | The Domain id of the goal. Possible values: (ID) |
| `name` | string | yes | The name of the goal. Possible values: (Text) |
| `type` | string | yes | The type of the goal. Possible values: url / duration / pages / ppc / event / funnel |
| `value_type` | number | no | Goal Value Type. Possible values: fixed / variable |
| `value` | string | no | Goal Value if the value type is fixed. Possible values: (Number) |
| `destination_url` | string | no | The Destination URL. Possible values: (Link) |
| `duration_hours` | number | no | The Duration Number of Hours. Possible values: (Number) |
| `duration_minutes` | number | no | The Duration Number of Minutes. Possible values: (Number) |
| `duration_seconds` | number | no | The Duration Number of Seconds. Possible values: (Number) |
| `pages` | number | no | The Number of Pages. Possible values: (Number) |
| `ppc_networks` | string | no | The type of Referral Networks. Possible values: google / bing / facebook / twitter / linkedin |
| `event_type` | string | no | The type of Event. Possible values: links / videos / form |
| `goal_event_filter` | string | no | Goal will be met if. Possible values: any / all |
| `event_links` | string | no | The Event Links. Possible values: (Link) |
| `event_videos` | integer | no | links of embedded video. Possible values: (Links) Allow Multiple: yes |
| `form_identity_type` | string | no | Form catch by Possible values: id / name |
| `form_identity` | string | no | The Form identity. Possible values: (Text) |

```js
var result = app.integrations.vbout.goal_add({
  domain_id: 123,
  name: "example",
  type: "example",
})
```
## goal_edit

Call the VBOUT Goal Edit endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the goal. Possible values: (ID) |
| `name` | string | yes | The name of the goal. Possible values: (Text) |
| `type` | string | yes | The type of the goal. Possible values: url / duration / pages / ppc / event / funnel |
| `value_type` | string | no | Goal Value Type. Possible values: fixed / variable |
| `value` | string | no | Goal Value if the value type is fixed. Possible values: (Number) |
| `destination_url` | string | no | The Destination URL. Possible values: (Link) |
| `duration_hours` | number | no | The Duration Number of Hours. Possible values: (Number) |
| `duration_minutes` | number | no | The Duration Number of Minutes. Possible values: (Number) |
| `duration_seconds` | number | no | The Duration Number of Minutes. Possible values: (Number) |
| `pages` | number | no | The Number of Pages. Possible values: (Number) |
| `ppc_networks` | string | no | The type of Referral Networks. Possible values: google / bing / facebook / twitter / linkedin |
| `event_type` | string | no | The type of Event. Possible values: links / videos / form |
| `goal_event_filter` | string | no | Goal will be met if. Possible values: any / all / all |
| `event_links` | string | no | The Event Links. Possible values: Link |
| `event_videos` | string | no | links of embedded video. Allow multiple: yes Possible values: (Links) |
| `form_identity_type` | string | no | Form catch by. Possible values: id / name |
| `form_identity` | string | no | The Form identity. Possible values: (Text) |

```js
var result = app.integrations.vbout.goal_edit({
  id: 123,
  name: "example",
  type: "example",
})
```
## goal_delete

Call the VBOUT Goal Delete endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.goal_delete({
})
```
## web_hook_lists

Call the VBOUT Web Hook lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.web_hook_lists({
})
```
## webhook_show

Call the VBOUT Webhook Show endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the webhook. Possible values: (ID) |

```js
var result = app.integrations.vbout.webhook_show({
  id: "example",
})
```
## webhook_add

Call the VBOUT Webhook Add endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the Popup. Possible values: (Text) |
| `type` | string | yes | The type of the Popup. Possible values: page_exit / page_entry / goal_trigger |
| `domain_id` | integer | no | The Domain id of the Popup. Possible values: (ID) |
| `action_url` | string | no | Page Url. Possible values: (Text) |
| `action_type` | string | no | The type of the action. Possible values: html_msg / form / poll / redirection / trigger_js |
| `redirection_url` | string | no | Redirection URL. Possible values: (Link) |
| `list_id` | integer | no | The List ID. Possible values: (ID) |
| `poll_question` | string | no | The Polling Question. Possible values: (Text) |
| `poll_choices` | string | no | The polling Choices. Possible values: (Text) Allow multiple: yes |
| `js_code` | string | no | The Javascript Code. Possible values: (Text) |
| `action_startdate` | string | no | The Action Trigger Start Date. Possible values: (Date) |
| `action_enddate` | string | no | The Action Trigger End Date. Possible values: (Date) |
| `action_targetusers` | string | no | The Target Users. Possible values: all / subscribers / anonymous |
| `action_devicefilter` | string | no | The Device Filter. Possible values: all / desktop / mobile |
| `action_ppcfilter` | string | no | The PPC Referral Network Filter. Possible values: google / bing / facebook / twitter / linkedin |
| `action_geofilter` | string | no | The Geo-Location Filter. Possible values: (Text) Allow Multiple: yes |
| `action_frequency` | string | no | The Action Frequency. Possible values: repeat / one_time |
| `delay_hours` | number | no | The Delay Number of Hours. Possible values: (Number) |
| `delay_minutes` | number | no | The Delay Number of Minutes. Possible values: (Number) |
| `delay_seconds` | number | no | The Delay Number of Seconds. Possible values: (Number) |
| `action_style` | string | no | Choose Action Style. Possible values: popup / sticky_bar |
| `action_text` | string | no | Action Text. Possible values: (Text) |

```js
var result = app.integrations.vbout.webhook_add({
  name: "example",
  type: "example",
})
```
## webhook_edit

Call the VBOUT Webhook Edit endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the Popup. Possible values: (Text) |
| `type` | string | yes | The type of the Popup. Possible values: page_exit / page_entry / goal_trigger |
| `id` | string | yes | The ID of the Popup. Possible values: (ID) |
| `action_url` | string | no | Page Url. Possible values: (Link) |
| `action_type` | string | no | The type of the action. Possible values: html_msg / form / poll / redirection / trigger_js |
| `redirection_url` | string | no | Redirection URL. Possible values: (Link) |
| `list_id` | string | no | The List ID. Possible values: (ID) |
| `poll_question` | string | no | The Polling Question. Possible values: (Text) |
| `poll_choices` | string | no | The polling Choices. Possible values: (Text) Allow multiple: Yes |
| `js_code` | string | no | The Javascript Code. Possible values: (Text) |
| `action_startdate` | string | no | The Action Trigger Start Date. Possible values: (Date) |
| `action_enddate` | string | no | The Action Trigger End Date. Possible values: (Date) |
| `action_targetusers` | string | no | The Target Users. Possible values: all / subscribers / anonymous |
| `action_devicefilter` | string | no | The Device Filter. Possible values: all / desktop / mobile |
| `action_ppcfilter` | string | no | The PPC Referral Network Filter. Possible values: google / bing / facebook / twitter / linkedin |
| `action_geofilter` | string | no | action_geofilter Possible values: (Text) Allow multiple: Yes |
| `action_frequency` | string | no | The Action Frequency. Possible values: repeat / one_time |
| `delay_hours` | string | no | The Delay Number of Hours. Possible values: (Number) |
| `delay_minutes` | string | no | The Delay Number of Minutes. Possible values: (Number) |
| `delay_seconds` | string | no | The Delay Number of Seconds. Possible values: (Number) |
| `action_style` | string | no | Choose Action Style Possible values: popup / sticky_bar |
| `action_text` | string | no | Action Text. Possible values: (Text) |

```js
var result = app.integrations.vbout.webhook_edit({
  name: "example",
  type: "example",
  id: "example",
})
```
## webhook_delete

Call the VBOUT Webhook Delete endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ID of the Popup to delete. Possible values: (ID) |

```js
var result = app.integrations.vbout.webhook_delete({
  id: "example",
})
```
## register_create_account

Call the VBOUT Register Create Account endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_name` | string | yes | The contact name. Possible values: (Text) |
| `business_name` | string | yes | The business name. Possible values: (Text) |
| `business_email` | string | yes | The business email. Possible values: (Email) |
| `business_phone` | string | yes | The business phone. Possible values: (Text) |
| `business_vbout_name` | string | yes | The business VBOUT name. Possible values: (Text) |
| `plan_id` | number | yes | The custom plan id. Possible values: (Number) |
| `business_password` | string | no | The business password. Possible values: (Text) |
| `business_vat_number` | string | no | The business VAT number. Possible values: (Text) |
| `timezone` | string | no | The business timezone. Possible values: https://www.php.net/manual/en/timezones.php |
| `commission_structure` | integer | no | The commission structure. Possible values: (1: Discount to paid amount) / (2: Normal commission payout) |
| `disable_billing_access` | integer | no | Disable Billing Access. Possible values: 0 / 1 |
| `disable_settings_access` | integer | no | Disable Settings Access. Possible values: 0 / 1 |
| `pay_on_signup` | integer | no | Pay using agency saved card on success signup, and save the card to the newly created account. Possible values: 0 / 1 |

```js
var result = app.integrations.vbout.register_create_account({
  contact_name: "example",
  business_name: "example",
  business_email: "example",
  business_phone: "example",
  business_vbout_name: "example",
  plan_id: 123,
})
```
## account_get_sub_account_auto_login

Call the VBOUT Account Subscriber Account Auto Login endpoint. Authentication: Required Response Formats: XML | JSON Note: It should work with Agencies only.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the sub-account. Possible values: (ID) |
| `expire` | integer | no | the number of seconds that the returned auto-login url will remain valid before it expire (MAX 3600 Seconds). Possible values: 1800 |

```js
var result = app.integrations.vbout.account_get_sub_account_auto_login({
  id: 123,
})
```
## settings_custom_shortcodes

Call the VBOUT Settings Custom Short codes endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None

Parameters: none.

```js
var result = app.integrations.vbout.settings_custom_shortcodes({
})
```
## settings_add_custom_shortcode

Call the VBOUT Settings Add Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content` | string | yes | The content of the short code. Possible values: (Text) |
| `name` | string | yes | The name of the short code. Possible values: (Text) |
| `title` | string | yes | The title of the short code. Possible values: (Text) |

```js
var result = app.integrations.vbout.settings_add_custom_shortcode({
  content: "example",
  name: "example",
  title: "example",
})
```
## settings_edit_custom_short_code

Call the VBOUT Settings Edit Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | number | yes | The id of the short code. Possible values: (ID) |
| `title` | string | yes | The title of the short code. Possible values: (Text) |
| `name` | string | yes | The name of the short code. Possible values: (Text) |
| `content` | string | yes | The content of the short code. Possible values: (Text) |

```js
var result = app.integrations.vbout.settings_edit_custom_short_code({
  id: 123,
  title: "example",
  name: "example",
  content: "example",
})
```
## settings_delete_custom_shortcode

Call the VBOUT Settings Delete Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | number | yes | The id of the short code. Possible values: (ID) |

```js
var result = app.integrations.vbout.settings_delete_custom_shortcode({
  id: 123,
})
```
## email_marketing_get_email_templates

Call the VBOUT Email Marketing Get Email Templates endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.email_marketing_get_email_templates({
})
```
## automation_get_guides

Call the VBOUT Automation Get Guides endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.automation_get_guides({
})
```
## automation_create_automation_from_guide

Call the VBOUT Automation Create Automation From Guide endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.automation_create_automation_from_guide({
})
```
## pipeline_get_board_guide_categories

Call the VBOUT Pipeline Get Board Guide Categories endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.pipeline_get_board_guide_categories({
})
```
## pipeline_get_board_guides

Call the VBOUT Pipeline Get Board Guides endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.pipeline_get_board_guides({
})
```
## pipeline_create_board_from_guide

Call the VBOUT Pipeline Create Board From Guide endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `guide_id` | integer | yes | The guideid of the pipeline. Possible values: (ID) |
| `title` | string | yes | The Title of the pipeline. Possible values: (ID) |

```js
var result = app.integrations.vbout.pipeline_create_board_from_guide({
  guide_id: 123,
  title: "example",
})
```
## aichatbot_aichatbottemplates

Call the VBOUT AIchatbot aichatbottemplates endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.aichatbot_aichatbottemplates({
})
```
## aichatbot_categories

Call the VBOUT AIchatbot categories endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.aichatbot_categories({
})
```
## aichatbot_tags

Call the VBOUT AIchatbot tags endpoint. Authentication: Required Response Formats: XML | JSON

Parameters: none.

```js
var result = app.integrations.vbout.aichatbot_tags({
})
```
## aichatbot_copy

Call the VBOUT AIchatbot copy endpoint. Authentication: Required Response Formats: XML | JSON

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | number | yes | The template_id from index. Possible values: (ID) |
| `name` | string | no | The Custom name of the chatbot. Possible values: (ID) |

```js
var result = app.integrations.vbout.aichatbot_copy({
  template_id: 123,
})
```
## Multi-Account Usage

Use `app.integrations.vbout.default` or a named account namespace when multiple VBOUT accounts are configured.
