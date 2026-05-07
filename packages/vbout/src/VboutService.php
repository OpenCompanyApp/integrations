<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the VBOUT REST API.
 *
 * Handles API-key authentication, request dispatch, response parsing, and the
 * official operation map exposed by the VBOUT OpenAPI document.
 */
class VboutService
{
    /**
     * @var array<string, array<string, mixed>>
     */
    private const OPERATIONS = [
  'app_me' =>
  [
    'slug' => 'vbout_get_current_user',
    'class' => 'VboutGetCurrentUser',
    'method' => 'GET',
    'path' => 'App/Me',
    'type' => 'read',
    'name' => 'Get Current User',
    'description' => 'Call the VBOUT Get Current User endpoint. Authentication: Required Response Formats: XML | JSON Particular endpoint Including All Possible Endpoints\' responses',
    'parameters' =>
    [
    ],
  ],
  'social_media_channels' =>
  [
    'slug' => 'vbout_social_media_channels',
    'class' => 'VboutSocialMediaChannels',
    'method' => 'GET',
    'path' => 'SocialMedia/Channels',
    'type' => 'read',
    'name' => 'Social Media Channels',
    'description' => 'Call the VBOUT Social Media Channels endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'social_media_calendar' =>
  [
    'slug' => 'vbout_social_media_calendar',
    'class' => 'VboutSocialMediaCalendar',
    'method' => 'GET',
    'path' => 'SocialMedia/Calendar',
    'type' => 'read',
    'name' => 'Social Media Calendar',
    'description' => 'Call the VBOUT Social Media Calendar endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'channels' =>
      [
        'api_name' => 'channels',
        'type' => 'string',
        'required' => false,
        'description' => 'The channels from where the posts are gathered. Possible Values: all | facebook | twitter | linkedin',
        'default' => 'all',
      ],
      'from' =>
      [
        'api_name' => 'from',
        'type' => 'string',
        'required' => true,
        'description' => 'The from date which the reviews are returned. The filter must be date for this parameter to work. Possible Values: (Date]',
        'default' => 'none',
      ],
      'to' =>
      [
        'api_name' => 'to',
        'type' => 'string',
        'required' => true,
        'description' => 'The to date which the reviews are returned. The filter must be date for this parameter to work. Possible Values: (Date]',
        'default' => 'none',
      ],
      'include_posted' =>
      [
        'api_name' => 'includeposted',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Include already scheduled posts inside the results. Possible Values: true | false',
        'default' => 'false',
      ],
      'limit' =>
      [
        'api_name' => 'limit',
        'type' => 'number',
        'required' => false,
        'description' => 'Set your record limit number per page. Possible Values:(Number]',
        'default' => 10,
      ],
      'page' =>
      [
        'api_name' => 'page',
        'type' => 'number',
        'required' => false,
        'description' => 'Set which page you wanna get. Possible Values:(Number]',
        'default' => 1,
      ],
      'sort' =>
      [
        'api_name' => 'sort',
        'type' => 'string',
        'required' => false,
        'description' => 'Record Sorting. Possible Values: asc | desc',
        'default' => 'asc',
      ],
    ],
  ],
  'social_media_stats' =>
  [
    'slug' => 'vbout_social_media_stats',
    'class' => 'VboutSocialMediaStats',
    'method' => 'GET',
    'path' => 'SocialMedia/Stats',
    'type' => 'read',
    'name' => 'Social Media Stats',
    'description' => 'Call the VBOUT Social Media Stats endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'channels' =>
      [
        'api_name' => 'channels',
        'type' => 'string',
        'required' => false,
        'description' => 'The channels where the posts are gathered from. Possible values: all | facebook | twitter | linkedin | pinterest',
        'default' => 'all',
      ],
      'sort' =>
      [
        'api_name' => 'sort',
        'type' => 'string',
        'required' => false,
        'description' => 'Record Sorting. Possible values: asc | desc',
        'default' => 'asc',
      ],
    ],
  ],
  'social_media_get_post' =>
  [
    'slug' => 'vbout_social_media_get_post',
    'class' => 'VboutSocialMediaGetPost',
    'method' => 'GET',
    'path' => 'SocialMedia/GetPost',
    'type' => 'read',
    'name' => 'Social Media Post',
    'description' => 'Call the VBOUT Social Media Post endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'ID',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the post Possible values: (ID]',
        'default' => 'none',
      ],
      'channel' =>
      [
        'api_name' => 'Channel',
        'type' => 'string',
        'required' => true,
        'description' => 'The channel where the post is created. Possible values: facebook | twitter | linkedin',
        'default' => 'none',
      ],
    ],
  ],
  'social_media_add_post' =>
  [
    'slug' => 'vbout_social_media_add_post',
    'class' => 'VboutSocialMediaAddPost',
    'method' => 'POST',
    'path' => 'SocialMedia/AddPost',
    'type' => 'write',
    'name' => 'Social Media Add Post',
    'description' => 'Call the VBOUT Social Media Add Post endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'message' =>
      [
        'api_name' => 'message',
        'type' => 'string',
        'required' => true,
        'description' => 'The post message to be scheduled/sent Possible values:"Text"',
        'default' => 'none',
      ],
      'channel' =>
      [
        'api_name' => 'channel',
        'type' => 'string',
        'required' => true,
        'description' => 'The channels which the post will be sent to. Possible values: facebook | twitter | linkedin | pinterest | instagram',
        'default' => 'none',
      ],
      'channel_id' =>
      [
        'api_name' => 'channelid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channels which the post will be sent to. Possible values: 1 | 2 | 3 | 4',
        'default' => 'none',
      ],
      'photo' =>
      [
        'api_name' => 'photo',
        'type' => 'string',
        'required' => false,
        'description' => 'The photo which will be attached to the post. Possible values: (Link] or (Uploaded Image]',
      ],
      'isscheduled' =>
      [
        'api_name' => 'isscheduled',
        'type' => 'boolean',
        'required' => false,
        'description' => 'This flag will make the post to be scheduled for future. Possible values: true | false',
        'default' => 'false',
      ],
      'scheduled_date' =>
      [
        'api_name' => 'scheduleddate',
        'type' => 'string',
        'required' => false,
        'description' => 'Date of the post to be scheduled. Possible values: (Date]',
        'default' => 'none',
      ],
      'scheduled_hours' =>
      [
        'api_name' => 'scheduledhours',
        'type' => 'string',
        'required' => false,
        'description' => 'Time of the post to be scheduled. Possible values: (Time]',
        'default' => 'none',
      ],
      'scheduled_ampm' =>
      [
        'api_name' => 'scheduledampm',
        'type' => 'string',
        'required' => false,
        'description' => 'AMPM of the post to be scheduled. Possible values: AM | PM | am | pm',
      ],
      'trackable_links' =>
      [
        'api_name' => 'trackableLinks',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Convert all links inside message to short urls. Possible values: true | false',
        'default' => 'false',
      ],
    ],
  ],
  'social_media_edit_post' =>
  [
    'slug' => 'vbout_social_media_edit_post',
    'class' => 'VboutSocialMediaEditPost',
    'method' => 'POST',
    'path' => 'SocialMedia/EditPost',
    'type' => 'write',
    'name' => 'Social Media Edit Post',
    'description' => 'Call the VBOUT Social Media Edit Post endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'ID of the post message to be edited. Possible values: (ID]',
        'default' => 'none',
      ],
      'channel' =>
      [
        'api_name' => 'channel',
        'type' => 'string',
        'required' => true,
        'description' => 'The channel where the post was scheduled. Possible values: facebook | twitter | linkedin | pinterest | instagram',
        'default' => 'none',
      ],
      'message' =>
      [
        'api_name' => 'message',
        'type' => 'string',
        'required' => false,
        'description' => 'The post message to be scheduled/sent. Possible values: (Text]',
        'default' => 'none',
      ],
      'scheduled_datetime' =>
      [
        'api_name' => 'scheduleddatetime',
        'type' => 'string',
        'required' => false,
        'description' => 'Date/Time of the post to be scheduled Possible values: (Datetime]',
      ],
    ],
  ],
  'social_media_delete_post' =>
  [
    'slug' => 'vbout_social_media_delete_post',
    'class' => 'VboutSocialMediaDeletePost',
    'method' => 'DELETE',
    'path' => 'SocialMedia/DeletePost',
    'type' => 'write',
    'name' => 'Social Media Delete Post',
    'description' => 'Call the VBOUT Social Media Delete Post endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'ID of the post message to be deleted. Possible Values:(ID]',
        'default' => 'none',
      ],
      'channel' =>
      [
        'api_name' => 'channel',
        'type' => 'string',
        'required' => false,
        'description' => 'The channels which the post will be sent to. Possible Values: facebook | twitter | linkedin',
        'default' => 'none',
      ],
    ],
  ],
  'email_marketing_campaigns' =>
  [
    'slug' => 'vbout_list_campaigns',
    'class' => 'VboutListCampaigns',
    'method' => 'GET',
    'path' => 'EmailMarketing/Campaigns',
    'type' => 'read',
    'name' => 'List Campaigns',
    'description' => 'Call the VBOUT List Campaigns endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'filter' =>
      [
        'api_name' => 'filter',
        'type' => 'string',
        'required' => true,
        'description' => 'The timeline during which the reviews are returned. Possible values: all | sent | scheduled | draft | automation',
        'default' => 'all',
      ],
      'from' =>
      [
        'api_name' => 'from',
        'type' => 'string',
        'required' => false,
        'description' => 'The from date which the reviews are returned. The filter must be \'date\' for this parameter to work. Possible values: (Date]',
        'default' => 'none',
      ],
      'to' =>
      [
        'api_name' => 'to',
        'type' => 'string',
        'required' => false,
        'description' => 'The from date which the reviews are returned. The filter must be \'date\' for this parameter to work. Possible values: (Date]',
        'default' => 'none',
      ],
      'limit' =>
      [
        'api_name' => 'limit',
        'type' => 'number',
        'required' => false,
        'description' => 'Set your record limit number per page. Possible values: (Number]',
        'default' => '10',
      ],
      'page' =>
      [
        'api_name' => 'page',
        'type' => 'number',
        'required' => false,
        'description' => 'Set which page you wanna get. Possible values: (Number]',
        'default' => 1,
      ],
    ],
  ],
  'email_marketing_get_campaign' =>
  [
    'slug' => 'vbout_get_campaign',
    'class' => 'VboutGetCampaign',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetCampaign',
    'type' => 'read',
    'name' => 'Get Campaign',
    'description' => 'Call the VBOUT Get Campaign endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the campaign to return. Possible Values: (ID]',
        'default' => 'none',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the campaign. Possible Values: standard | automated',
        'default' => 'standard',
      ],
    ],
  ],
  'email_marketing_stats' =>
  [
    'slug' => 'vbout_email_marketing_stats',
    'class' => 'VboutEmailMarketingStats',
    'method' => 'GET',
    'path' => 'EmailMarketing/Stats',
    'type' => 'read',
    'name' => 'Email Marketing Stats',
    'description' => 'Call the VBOUT Email Marketing Stats endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the campaign to return. Possible values: (ID]',
        'default' => 'none',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the campaign. Possible values: standard | automated',
        'default' => 'standard',
      ],
    ],
  ],
  'email_marketing_add_campaign' =>
  [
    'slug' => 'vbout_email_marketing_add_campaign',
    'class' => 'VboutEmailMarketingAddCampaign',
    'method' => 'POST',
    'path' => 'EmailMarketing/AddCampaign',
    'type' => 'write',
    'name' => 'Email Marketing Add Campaign',
    'description' => 'Call the VBOUT Email Marketing Add Campaign endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'subject' =>
      [
        'api_name' => 'subject',
        'type' => 'string',
        'required' => true,
        'description' => 'The subject line for the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'from_email' =>
      [
        'api_name' => 'fromemail',
        'type' => 'string',
        'required' => true,
        'description' => 'The from email of the campaign. Possible values: (Email]',
        'default' => 'none',
      ],
      'from_name' =>
      [
        'api_name' => 'from_name',
        'type' => 'string',
        'required' => true,
        'description' => 'The from name of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'reply_to' =>
      [
        'api_name' => 'reply_to',
        'type' => 'string',
        'required' => true,
        'description' => 'The reply to email of the campaign. Possible values: (Email]',
        'default' => 'none',
      ],
      'body' =>
      [
        'api_name' => 'body',
        'type' => 'string',
        'required' => true,
        'description' => 'Message body. Possible values: (Text]',
        'default' => 'none',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the campaign. Possible values: standard | automated',
        'default' => 'standard',
      ],
      'isscheduled' =>
      [
        'api_name' => 'isscheduled',
        'type' => 'boolean',
        'required' => false,
        'description' => 'The flag to schedule the campaign for the future. Possible values: true | false',
        'default' => 'false',
      ],
      'isdraft' =>
      [
        'api_name' => 'isdraft',
        'type' => 'boolean',
        'required' => false,
        'description' => 'The flag to set the campaign to draft. Possible values: true | false',
        'default' => 'false',
      ],
      'scheduled_datetime' =>
      [
        'api_name' => 'scheduled_datetime',
        'type' => 'string',
        'required' => false,
        'description' => 'The date and time to schedule the campaign. Possible values: (Date]',
        'default' => 'none',
      ],
      'audiences' =>
      [
        'api_name' => 'audiences',
        'type' => 'integer',
        'required' => false,
        'description' => 'IDs of audience campaign recipients.(comma separated] Possible values: (IDs]',
        'default' => 'none',
      ],
      'lists' =>
      [
        'api_name' => 'lists',
        'type' => 'integer',
        'required' => false,
        'description' => 'IDs of list campaign recipients.(comma separated] Possible values: (IDs]',
        'default' => 'none',
      ],
    ],
  ],
  'email_marketing_edit_campaign' =>
  [
    'slug' => 'vbout_email_marketing_edit_campaign',
    'class' => 'VboutEmailMarketingEditCampaign',
    'method' => 'POST',
    'path' => 'EmailMarketing/EditCampaign',
    'type' => 'write',
    'name' => 'Email Marketing Edit Campaign',
    'description' => 'Call the VBOUT Email Marketing Edit Campaign endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the campaign. Possible values: (ID]',
        'default' => 'none',
      ],
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'subject' =>
      [
        'api_name' => 'subject',
        'type' => 'string',
        'required' => true,
        'description' => 'The subject line of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'body' =>
      [
        'api_name' => 'body',
        'type' => 'string',
        'required' => true,
        'description' => 'Message body. Possible values: (Text]',
        'default' => 'none',
      ],
      'from_email' =>
      [
        'api_name' => 'fromemail',
        'type' => 'string',
        'required' => true,
        'description' => 'The from email of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'from_name' =>
      [
        'api_name' => 'from_name',
        'type' => 'string',
        'required' => true,
        'description' => 'The from name of the campaign. Possible values: (Text]',
        'default' => 'none',
      ],
      'reply_to' =>
      [
        'api_name' => 'reply_to',
        'type' => 'string',
        'required' => true,
        'description' => 'The reply to email of the campaign. Possible values:(Email]',
        'default' => 'none',
      ],
      'isscheduled' =>
      [
        'api_name' => 'isscheduled',
        'type' => 'boolean',
        'required' => false,
        'description' => 'The flag to schedule the campaign for the future. Possible values: true | false',
        'default' => 'false',
      ],
      'isdraft' =>
      [
        'api_name' => 'isdraft',
        'type' => 'boolean',
        'required' => false,
        'description' => 'The flag to set the campaign to draft. Possible values: true | false',
        'default' => 'false',
      ],
      'scheduled_datetime' =>
      [
        'api_name' => 'scheduled_datetime',
        'type' => 'string',
        'required' => false,
        'description' => 'The date time to schedule the campaign.',
        'default' => 'none',
      ],
      'audiences' =>
      [
        'api_name' => 'audiences',
        'type' => 'integer',
        'required' => false,
        'description' => 'IDs of audience campaign recipients.(comma separated] Possible values: (IDs]',
        'default' => 'none',
      ],
      'lists' =>
      [
        'api_name' => 'lists',
        'type' => 'integer',
        'required' => false,
        'description' => 'IDs of list campaign recipients.(comma separated] Possible values: (IDs]',
        'default' => 'none',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the campaign. Possible values: standard | automated',
        'default' => 'standard',
      ],
    ],
  ],
  'email_marketing_delete_campaign' =>
  [
    'slug' => 'vbout_email_marketing_delete_campaign',
    'class' => 'VboutEmailMarketingDeleteCampaign',
    'method' => 'DELETE',
    'path' => 'EmailMarketing/DeleteCampaign',
    'type' => 'write',
    'name' => 'Email Marketing Delete Campaign',
    'description' => 'Call the VBOUT Email Marketing Delete Campaign endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the campaign to delete. Possible values: (ID]',
        'default' => 'none',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the campaign. Possible values: standard | automated',
        'default' => 'standard',
      ],
    ],
  ],
  'email_marketing_get_contacts' =>
  [
    'slug' => 'vbout_list_contacts',
    'class' => 'VboutListContacts',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContacts',
    'type' => 'read',
    'name' => 'List Contacts',
    'description' => 'Call the VBOUT List Contacts endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to return its contacts. Possible values: (IDs]',
        'default' => '0',
      ],
    ],
  ],
  'email_marketing_get_contacts_by_phone_number' =>
  [
    'slug' => 'vbout_email_marketing_get_contacts_by_phone_number',
    'class' => 'VboutEmailMarketingGetContactsByPhoneNumber',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContactsByPhoneNumber',
    'type' => 'read',
    'name' => 'Email Marketing Contacts By Phone Number',
    'description' => 'Call the VBOUT Email Marketing Contacts By Phone Number endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to return its contacts. Possible values: (IDs]',
        'default' => '0',
      ],
    ],
  ],
  'email_marketing_get_contact_by_email' =>
  [
    'slug' => 'vbout_email_marketing_get_contact_by_email',
    'class' => 'VboutEmailMarketingGetContactByEmail',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContactByEmail',
    'type' => 'read',
    'name' => 'Email Marketing Contact By Email',
    'description' => 'Call the VBOUT Email Marketing Contact By Email endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => true,
        'description' => 'The Email of the contact to return.Possible values: (Email]',
        'default' => 'none',
      ],
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => false,
        'description' => 'The List id of which this contact does belong to.Possible values:(ID]',
        'default' => 'none',
      ],
    ],
  ],
  'email_marketing_get_contact' =>
  [
    'slug' => 'vbout_get_contact',
    'class' => 'VboutGetContact',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContact',
    'type' => 'read',
    'name' => 'Get Contact',
    'description' => 'Call the VBOUT Get Contact endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact to return. Possible values: (ID]',
        'default' => 'none',
      ],
    ],
  ],
  'email_marketing_add_contact' =>
  [
    'slug' => 'vbout_create_contact',
    'class' => 'VboutCreateContact',
    'method' => 'POST',
    'path' => 'EmailMarketing/AddContact',
    'type' => 'write',
    'name' => 'Create Contact',
    'description' => 'Call the VBOUT Create Contact endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to assign this contact to. Possible values: (ID]',
      ],
      'status' =>
      [
        'api_name' => 'status',
        'type' => 'string',
        'required' => true,
        'description' => 'The status of the contact. Possible values: (Active | Disactive]',
        'default' => 'None',
      ],
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => false,
        'description' => 'The email of the contact. Possible values: (Email]',
        'default' => 'None',
      ],
      'ip_address' =>
      [
        'api_name' => 'ipaddress',
        'type' => 'string',
        'required' => false,
        'description' => 'The ip of the contact. Possible values: (IP]',
        'default' => 'None',
      ],
      'fields' =>
      [
        'api_name' => 'fields',
        'type' => 'array',
        'required' => false,
        'description' => 'The list of custom fields added to a specific list. Possible values: Array(\'fieldID\'=>\'fieldValue\'] Accepted Date Formats: Y-m-d | d-m-Y | m/d/Y',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_edit_contact' =>
  [
    'slug' => 'vbout_email_marketing_edit_contact',
    'class' => 'VboutEmailMarketingEditContact',
    'method' => 'POST',
    'path' => 'EmailMarketing/EditContact',
    'type' => 'write',
    'name' => 'Email Marketing Edit Contact',
    'description' => 'Call the VBOUT Email Marketing Edit Contact endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact. Possible values: (ID]',
        'default' => 'None',
      ],
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => false,
        'description' => 'The email of the contact. Possible values: (Email]',
        'default' => 'None',
      ],
      'ip_address' =>
      [
        'api_name' => 'ipaddress',
        'type' => 'string',
        'required' => false,
        'description' => 'The ip of the contact. Possible values: (IP]',
        'default' => 'None',
      ],
      'status' =>
      [
        'api_name' => 'status',
        'type' => 'string',
        'required' => false,
        'description' => 'The status of the contact. Possible values: (Active | Disactive]',
        'default' => 'None',
      ],
      'fields' =>
      [
        'api_name' => 'fields',
        'type' => 'array',
        'required' => false,
        'description' => 'The list of custom fields added to a specific list. Possible values: Array(\'fieldID\'=>\'fieldValue\'] Accepted Date Formats: Y-m-d | d-m-Y | m/d/Y',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_sync_contact' =>
  [
    'slug' => 'vbout_email_marketing_sync_contact',
    'class' => 'VboutEmailMarketingSyncContact',
    'method' => 'POST',
    'path' => 'EmailMarketing/SyncContact',
    'type' => 'write',
    'name' => 'Email Marketing Sync Contact',
    'description' => 'Call the VBOUT Email Marketing Sync Contact endpoint. Authentication: Required Response Formats: XML | JSON Note: All emails having the same email text available in the provided list will be updated if exists (case email is not required].',
    'parameters' =>
    [
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => true,
        'description' => 'The email of the contact. Possible values: (Email]',
        'default' => 'None',
      ],
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => false,
        'description' => 'The ID of the list to assign this contact to. Possible values: (ID]',
        'default' => 'None',
      ],
      'ip_address' =>
      [
        'api_name' => 'ipaddress',
        'type' => 'string',
        'required' => false,
        'description' => 'The ip of the contact. Possible values: (IP]',
        'default' => 'None',
      ],
      'status' =>
      [
        'api_name' => 'status',
        'type' => 'string',
        'required' => false,
        'description' => 'The status of the contact. Possible values: (Active | Disactive]',
        'default' => 'None',
      ],
      'fields' =>
      [
        'api_name' => 'fields',
        'type' => 'array',
        'required' => false,
        'description' => 'The list of custom fields added to a specific list. Possible values: Array(\'fieldID\'=>\'fieldValue\'] Accepted Date Formats: Y-m-d | d-m-Y | m/d/Y',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_delete_contact' =>
  [
    'slug' => 'vbout_email_marketing_delete_contact',
    'class' => 'VboutEmailMarketingDeleteContact',
    'method' => 'DELETE',
    'path' => 'EmailMarketing/DeleteContact',
    'type' => 'write',
    'name' => 'Email Marketing Delete Contact',
    'description' => 'Call the VBOUT Email Marketing Delete Contact endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact to delete. Possible values: (ID]',
        'default' => 'None',
      ],
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to delete from. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_move_contact' =>
  [
    'slug' => 'vbout_email_marketing_move_contact',
    'class' => 'VboutEmailMarketingMoveContact',
    'method' => 'POST',
    'path' => 'EmailMarketing/MoveContact',
    'type' => 'write',
    'name' => 'Email Marketing Move Contact',
    'description' => 'Call the VBOUT Email Marketing Move Contact endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact. Possible Values: (ID]',
        'default' => 'None',
      ],
      'list_id' =>
      [
        'api_name' => 'listid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to assign this contact to. Possible values: (ID]',
        'default' => 'None',
      ],
      'sourceid' =>
      [
        'api_name' => 'sourceid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to assign this contact to. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_get_contact_timeline' =>
  [
    'slug' => 'vbout_email_marketing_get_contact_timeline',
    'class' => 'VboutEmailMarketingGetContactTimeline',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContactTimeline',
    'type' => 'read',
    'name' => 'Email Marketing Contact Timeline',
    'description' => 'Call the VBOUT Email Marketing Contact Timeline endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact to return his timeline activities. Possible values: (ID]',
        'default' => 'None',
      ],
      'include' =>
      [
        'api_name' => 'include',
        'type' => 'string',
        'required' => false,
        'description' => 'Comma separated keys to return other details with the timeline activities. Possible values: utm | automated',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_get_contact_timeline_by_email_address' =>
  [
    'slug' => 'vbout_email_marketing_get_contact_timeline_by_email_address',
    'class' => 'VboutEmailMarketingGetContactTimelineByEmailAddress',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetContactTimelineByEmailAddress',
    'type' => 'read',
    'name' => 'Email Marketing Contact Timeline By Email Address',
    'description' => 'Call the VBOUT Email Marketing Contact Timeline By Email Address endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'email' =>
      [
        'api_name' => 'Email',
        'type' => 'string',
        'required' => true,
        'description' => 'The email address for the contact to return his timeline activities. Possible values: (ID]',
        'default' => 'None',
      ],
      'include' =>
      [
        'api_name' => 'Include',
        'type' => 'string',
        'required' => false,
        'description' => 'Comma separated keys to return other details with the timeline activities. Possible values: utm | automated',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_get_audiences' =>
  [
    'slug' => 'vbout_email_marketing_get_audiences',
    'class' => 'VboutEmailMarketingGetAudiences',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetAudiences',
    'type' => 'read',
    'name' => 'Email Marketing Audiences',
    'description' => 'Call the VBOUT Email Marketing Audiences endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'email_marketing_get_lists' =>
  [
    'slug' => 'vbout_email_marketing_get_lists',
    'class' => 'VboutEmailMarketingGetLists',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetLists',
    'type' => 'read',
    'name' => 'Email Marketing Lists',
    'description' => 'Call the VBOUT Email Marketing Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'email_marketing_get_list' =>
  [
    'slug' => 'vbout_email_marketing_get_list',
    'class' => 'VboutEmailMarketingGetList',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetList',
    'type' => 'read',
    'name' => 'Email Marketing List',
    'description' => 'Call the VBOUT Email Marketing List endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to return. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_add_list' =>
  [
    'slug' => 'vbout_email_marketing_add_list',
    'class' => 'VboutEmailMarketingAddList',
    'method' => 'POST',
    'path' => 'EmailMarketing/AddList',
    'type' => 'write',
    'name' => 'Email Marketing Add List',
    'description' => 'Call the VBOUT Email Marketing Add List endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the list. Possible values: (Text]',
        'default' => 'None',
      ],
      'email_subject' =>
      [
        'api_name' => 'email_subject',
        'type' => 'string',
        'required' => false,
        'description' => 'The default subscription subject. Possible values: (Text]',
        'default' => 'None',
      ],
      'reply_to' =>
      [
        'api_name' => 'reply_to',
        'type' => 'string',
        'required' => false,
        'description' => 'The Reply to email of the list. Possible values: (Email]',
        'default' => 'None',
      ],
      'from_email' =>
      [
        'api_name' => 'fromemail',
        'type' => 'string',
        'required' => false,
        'description' => 'The From email of the list. Possible values: (Email]',
        'default' => 'None',
      ],
      'from_name' =>
      [
        'api_name' => 'from_name',
        'type' => 'integer',
        'required' => false,
        'description' => 'The From name of the list. Possible values: (Text]',
        'default' => 'None',
      ],
      'double_optin' =>
      [
        'api_name' => 'doubleOptin',
        'type' => 'string',
        'required' => false,
        'description' => 'Email confirmation required (Double opt-in]? Possible values: 0 | 1',
        'default' => 'None',
      ],
      'notify' =>
      [
        'api_name' => 'notify',
        'type' => 'string',
        'required' => false,
        'description' => 'Notify me of new subscribers. Possible values: (Text]',
      ],
      'notify_email' =>
      [
        'api_name' => 'notify_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Notification Email. Possible values: (Email]',
        'default' => 'None',
      ],
      'success_email' =>
      [
        'api_name' => 'success_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Success Email. Possible values: (Email]',
        'default' => 'None',
      ],
      'success_message' =>
      [
        'api_name' => 'success_message',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Success Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'error_message' =>
      [
        'api_name' => 'error_message',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Error Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'confirmation_email' =>
      [
        'api_name' => 'confirmation_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Confirmation Email Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'confirmation_message' =>
      [
        'api_name' => 'confirmation_message',
        'type' => 'string',
        'required' => false,
        'description' => 'Confirmation Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'communications' =>
      [
        'api_name' => 'communications',
        'type' => 'string',
        'required' => false,
        'description' => 'Turn off Communications? (0-No | 1-Yes] Possible values: 0 | 1',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_editlist' =>
  [
    'slug' => 'vbout_email_marketing_editlist',
    'class' => 'VboutEmailMarketingEditlist',
    'method' => 'POST',
    'path' => 'EmailMarketing/Editlist',
    'type' => 'write',
    'name' => 'Email Marketing Edit List',
    'description' => 'Call the VBOUT Email Marketing Edit List endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the list. Possible values: (Number]',
        'default' => 'None',
      ],
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the list. Possible values: (Text]',
        'default' => 'None',
      ],
      'email_subject' =>
      [
        'api_name' => 'email_subject',
        'type' => 'string',
        'required' => false,
        'description' => 'The default subject line of subscription. Possible values: (Text]',
        'default' => 'None',
      ],
      'reply_to' =>
      [
        'api_name' => 'reply_to',
        'type' => 'string',
        'required' => false,
        'description' => 'The Reply to email of the list. Possible values: (Email]',
        'default' => 'None',
      ],
      'from_email' =>
      [
        'api_name' => 'fromemail',
        'type' => 'string',
        'required' => false,
        'description' => 'The From email of the list. Possible values: (Email]',
        'default' => 'None',
      ],
      'from_name' =>
      [
        'api_name' => 'from_name',
        'type' => 'string',
        'required' => false,
        'description' => 'The From name of the list. Possible values: (Text]',
        'default' => 'None',
      ],
      'double_optin' =>
      [
        'api_name' => 'doubleOptin',
        'type' => 'string',
        'required' => false,
        'description' => 'Email confirmation required (Double opt-in]?. Possible values: 0 | 1',
        'default' => 'None',
      ],
      'notify' =>
      [
        'api_name' => 'notify',
        'type' => 'string',
        'required' => false,
        'description' => 'Notify me of new subscribers. Possible values: (Text]',
        'default' => 'None',
      ],
      'notify_email' =>
      [
        'api_name' => 'notify_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Notification Email. Possible values:(Email]',
        'default' => 'None',
      ],
      'success_email' =>
      [
        'api_name' => 'success_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Success Email. Possible values: (Text]',
        'default' => 'None',
      ],
      'success_message' =>
      [
        'api_name' => 'success_message',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Success Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'error_message' =>
      [
        'api_name' => 'error_message',
        'type' => 'string',
        'required' => false,
        'description' => 'Subscription Error Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'confirmation_email' =>
      [
        'api_name' => 'confirmation_email',
        'type' => 'string',
        'required' => false,
        'description' => 'Confirmation Email Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'confirmation_email_message' =>
      [
        'api_name' => 'Confirmation Email Message.',
        'type' => 'string',
        'required' => false,
        'description' => 'Confirmation Message. Possible values: (Text]',
        'default' => 'None',
      ],
      'communications' =>
      [
        'api_name' => 'communications',
        'type' => 'string',
        'required' => false,
        'description' => 'Turn off Communications? (0-No | 1-Yes] Possible values: 0 | 1',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_delete_list' =>
  [
    'slug' => 'vbout_email_marketing_delete_list',
    'class' => 'VboutEmailMarketingDeleteList',
    'method' => 'DELETE',
    'path' => 'EmailMarketing/DeleteList',
    'type' => 'write',
    'name' => 'Email Marketing Delete List',
    'description' => 'Call the VBOUT Email Marketing Delete List endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the list to delete. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_add_activity' =>
  [
    'slug' => 'vbout_email_marketing_add_activity',
    'class' => 'VboutEmailMarketingAddActivity',
    'method' => 'POST',
    'path' => 'EmailMarketing/AddActivity',
    'type' => 'write',
    'name' => 'Email Marketing Add Activity',
    'description' => 'Call the VBOUT Email Marketing Add Activity endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the contact. Possible values: (ID]',
        'default' => 'None',
      ],
      'description' =>
      [
        'api_name' => 'description',
        'type' => 'string',
        'required' => true,
        'description' => 'The description of the activity. Possible values: (Text]',
        'default' => 'None',
      ],
      'datetime' =>
      [
        'api_name' => 'datetime',
        'type' => 'string',
        'required' => true,
        'description' => 'The date and time to activity. Possible values: (DateTime]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_add_tag' =>
  [
    'slug' => 'vbout_email_marketing_add_tag',
    'class' => 'VboutEmailMarketingAddTag',
    'method' => 'POST',
    'path' => 'EmailMarketing/AddTag',
    'type' => 'write',
    'name' => 'Email Marketing Add Tag',
    'description' => 'Call the VBOUT Email Marketing Add Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used.',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => false,
        'description' => 'The id of the contact. Possible values: (ID]',
        'default' => 'None',
      ],
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => true,
        'description' => 'The email of the contact. Possible values: (text]',
        'default' => 'None',
      ],
      'tagname' =>
      [
        'api_name' => 'tagname',
        'type' => 'string',
        'required' => true,
        'description' => 'Tag(s] to be added. Possible values: (Text]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_remove_tag' =>
  [
    'slug' => 'vbout_email_marketing_remove_tag',
    'class' => 'VboutEmailMarketingRemoveTag',
    'method' => 'DELETE',
    'path' => 'EmailMarketing/RemoveTag',
    'type' => 'write',
    'name' => 'Email Marketing Remove Tag',
    'description' => 'Call the VBOUT Email Marketing Remove Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => false,
        'description' => 'The id of the contact. Possible values: (ID]',
        'default' => 'None',
      ],
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => true,
        'description' => 'The email of the contact. Possible values: (text]',
        'default' => 'None',
      ],
      'tagname' =>
      [
        'api_name' => 'tagname',
        'type' => 'string',
        'required' => true,
        'description' => 'Tag(s] to be added. Possible values: (text]',
        'default' => 'None',
      ],
    ],
  ],
  'email_marketing_get_coupon' =>
  [
    'slug' => 'vbout_email_marketing_get_coupon',
    'class' => 'VboutEmailMarketingGetCoupon',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetCoupon',
    'type' => 'read',
    'name' => 'Email Marketing Coupon',
    'description' => 'Call the VBOUT Email Marketing Coupon endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'email' =>
      [
        'api_name' => 'email',
        'type' => 'string',
        'required' => true,
        'description' => 'The email of the contact to return coupons of. Possible values: (Email]',
        'default' => 'john@doe.com',
      ],
      'campaign_id' =>
      [
        'api_name' => 'campaignid',
        'type' => 'string',
        'required' => false,
        'description' => 'The ID of the campaign containing coupons. Possible values: (Campaign id]',
        'default' => '1254',
      ],
    ],
  ],
  'user_lists' =>
  [
    'slug' => 'vbout_user_lists',
    'class' => 'VboutUserLists',
    'method' => 'GET',
    'path' => 'User/Lists',
    'type' => 'read',
    'name' => 'User Lists',
    'description' => 'Call the VBOUT User Lists endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'business_id' =>
      [
        'api_name' => 'businessid',
        'type' => 'string',
        'required' => false,
        'description' => 'The ID of the business if it\'s an agency to return its contacts. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'user_managers' =>
  [
    'slug' => 'vbout_user_managers',
    'class' => 'VboutUserManagers',
    'method' => 'GET',
    'path' => 'User/Managers',
    'type' => 'read',
    'name' => 'User Managers',
    'description' => 'Call the VBOUT User Managers endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'user_status' =>
  [
    'slug' => 'vbout_user_status',
    'class' => 'VboutUserStatus',
    'method' => 'POST',
    'path' => 'User/Status',
    'type' => 'write',
    'name' => 'User Status',
    'description' => 'Call the VBOUT User Status endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user to change status. Possible values: (ID]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the user. Possible values: user | manager',
        'default' => 'User',
      ],
      'status' =>
      [
        'api_name' => 'status',
        'type' => 'string',
        'required' => true,
        'description' => 'The status of the user. Possible values: enable | disable',
        'default' => 'enable',
      ],
    ],
  ],
  'user_add' =>
  [
    'slug' => 'vbout_user_add',
    'class' => 'VboutUserAdd',
    'method' => 'POST',
    'path' => 'User/Add',
    'type' => 'write',
    'name' => 'User Add',
    'description' => 'Call the VBOUT User Add endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'fullname' =>
      [
        'api_name' => 'fullname',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the user. Possible values: (Text]',
        'default' => 'None',
      ],
      'username' =>
      [
        'api_name' => 'username',
        'type' => 'string',
        'required' => true,
        'description' => 'The username of the user. Possible values: (Email Address]',
      ],
      'password' =>
      [
        'api_name' => 'password',
        'type' => 'string',
        'required' => true,
        'description' => 'The password of the user. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the user. Possible values: user | manager',
        'default' => 'User',
      ],
      'group' =>
      [
        'api_name' => 'group',
        'type' => 'string',
        'required' => false,
        'description' => 'The group id of the user. Possible values: (ID]',
        'default' => '0',
      ],
      'permissions' =>
      [
        'api_name' => 'permissions',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional Required: if no group is selected. The permissions of the user. (comma-separated values] Possible values: all | reputation_center | foursquare | pinterest | social_media | email_marketing | master_reporting | users_and_workflow | user_groups | smart_calendar | site_builder | asset_manager | task_manager | notes | social_tracker | google_analytics | email_automation_workflow | live_hashtags | goal_conversion_tracking | expedia_affiliate_network | behavioral_webhooks | lead_scoring | landingpages | sms_automation | heatmap | email_test | salesforce_sync | browser_push | hubspot_sync | zoho_sync | pipeline_manager | campaign_groups | webinars | content_bank | insightly_sync | ftp_sync | simplifi_reports | custom_smtp | call_center',
        'default' => 'Null',
      ],
    ],
  ],
  'user_edit' =>
  [
    'slug' => 'vbout_user_edit',
    'class' => 'VboutUserEdit',
    'method' => 'POST',
    'path' => 'User/Edit',
    'type' => 'write',
    'name' => 'User Edit',
    'description' => 'Call the VBOUT User Edit endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user. Possible values: (ID]',
        'default' => 'None',
      ],
      'fullname' =>
      [
        'api_name' => 'fullname',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the user. Possible values: (Text]',
        'default' => 'None',
      ],
      'username' =>
      [
        'api_name' => 'username',
        'type' => 'string',
        'required' => true,
        'description' => 'The username of the user. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the user. Possible values: (user | manager]',
        'default' => 'User',
      ],
      'password' =>
      [
        'api_name' => 'password',
        'type' => 'string',
        'required' => false,
        'description' => 'The password of the user. Possible values: (Text]',
        'default' => 'None',
      ],
      'group' =>
      [
        'api_name' => 'group',
        'type' => 'string',
        'required' => false,
        'description' => 'The group id of the user. Possible values: (ID]',
        'default' => '0',
      ],
      'permissions' =>
      [
        'api_name' => 'permissions',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional Required: if no group is selected. The permissions of the user. (comma-separated values] Possible values: all | reputation_center | foursquare | pinterest | social_media | email_marketing | master_reporting | users_and_workflow | user_groups | smart_calendar | site_builder | asset_manager | task_manager | notes | social_tracker | google_analytics | email_automation_workflow | live_hashtags | goal_conversion_tracking | expedia_affiliate_network | behavioral_webhooks | lead_scoring | landingpages | sms_automation | heatmap | email_test | salesforce_sync | browser_push | hubspot_sync | zoho_sync | pipeline_manager | campaign_groups | webinars | content_bank | insightly_sync | ftp_sync | simplifi_reports | custom_smtp | call_center',
        'default' => 'Null',
      ],
    ],
  ],
  'user_delete' =>
  [
    'slug' => 'vbout_user_delete',
    'class' => 'VboutUserDelete',
    'method' => 'DELETE',
    'path' => 'User/Delete',
    'type' => 'write',
    'name' => 'User Delete',
    'description' => 'Call the VBOUT User Delete endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the user to delete. Possible values: (ID]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the user. Possible values: user | manager',
        'default' => 'User',
      ],
    ],
  ],
  'user_groups' =>
  [
    'slug' => 'vbout_user_groups',
    'class' => 'VboutUserGroups',
    'method' => 'GET',
    'path' => 'User/Groups',
    'type' => 'read',
    'name' => 'User Groups',
    'description' => 'Call the VBOUT User Groups endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'user_group_delete' =>
  [
    'slug' => 'vbout_user_group_delete',
    'class' => 'VboutUserGroupDelete',
    'method' => 'DELETE',
    'path' => 'User/GroupDelete',
    'type' => 'write',
    'name' => 'User Group Delete',
    'description' => 'Call the VBOUT User Group Delete endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group to delete. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'user_group_status' =>
  [
    'slug' => 'vbout_user_group_status',
    'class' => 'VboutUserGroupStatus',
    'method' => 'GET',
    'path' => 'User/GroupStatus',
    'type' => 'read',
    'name' => 'User Group Status',
    'description' => 'Call the VBOUT User Group Status endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the group to change status. Possible values: (ID]',
        'default' => 'None',
      ],
      'status' =>
      [
        'api_name' => 'status',
        'type' => 'string',
        'required' => true,
        'description' => 'The status of the group. Possible values: enable | disable',
        'default' => 'enable',
      ],
    ],
  ],
  'goal_lists' =>
  [
    'slug' => 'vbout_goal_lists',
    'class' => 'VboutGoalLists',
    'method' => 'GET',
    'path' => 'Goal/Lists',
    'type' => 'read',
    'name' => 'Goal Lists',
    'description' => 'Call the VBOUT Goal Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'goal_list_by_domain' =>
  [
    'slug' => 'vbout_goal_list_by_domain',
    'class' => 'VboutGoalListByDomain',
    'method' => 'GET',
    'path' => 'Goal/ListByDomain',
    'type' => 'read',
    'name' => 'Goal List By Domain',
    'description' => 'Call the VBOUT Goal List By Domain endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'domain_id' =>
      [
        'api_name' => 'domainid',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the domain to return its goals. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'goal_show' =>
  [
    'slug' => 'vbout_goal_show',
    'class' => 'VboutGoalShow',
    'method' => 'GET',
    'path' => 'Goal/Show',
    'type' => 'read',
    'name' => 'Goal Show',
    'description' => 'Call the VBOUT Goal Show endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the goal. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'goal_add' =>
  [
    'slug' => 'vbout_goal_add',
    'class' => 'VboutGoalAdd',
    'method' => 'POST',
    'path' => 'Goal/Add',
    'type' => 'write',
    'name' => 'Goal Add',
    'description' => 'Call the VBOUT Goal Add endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'domain_id' =>
      [
        'api_name' => 'domainid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The Domain id of the goal. Possible values: (ID]',
        'default' => 'None',
      ],
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the goal. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the goal. Possible values: url | duration | pages | ppc | event | funnel',
        'default' => 'Url',
      ],
      'value_type' =>
      [
        'api_name' => 'value_type',
        'type' => 'number',
        'required' => false,
        'description' => 'Goal Value Type. Possible values: fixed | variable',
        'default' => 'Fixed',
      ],
      'value' =>
      [
        'api_name' => 'value',
        'type' => 'string',
        'required' => false,
        'description' => 'Goal Value if the value type is fixed. Possible values: (Number]',
        'default' => '0',
      ],
      'destination_url' =>
      [
        'api_name' => 'destination_url',
        'type' => 'string',
        'required' => false,
        'description' => 'The Destination URL. Possible values: (Link]',
        'default' => 'None',
      ],
      'duration_hours' =>
      [
        'api_name' => 'duration_hours',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Hours. Possible values: (Number]',
        'default' => '0',
      ],
      'duration_minutes' =>
      [
        'api_name' => 'duration_minutes',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Minutes. Possible values: (Number]',
        'default' => '0',
      ],
      'duration_seconds' =>
      [
        'api_name' => 'duration_seconds',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Seconds. Possible values: (Number]',
        'default' => '0',
      ],
      'pages' =>
      [
        'api_name' => 'pages',
        'type' => 'number',
        'required' => false,
        'description' => 'The Number of Pages. Possible values: (Number]',
        'default' => 'None',
      ],
      'ppc_networks' =>
      [
        'api_name' => 'ppc_networks',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of Referral Networks. Possible values: google | bing | facebook | twitter | linkedin',
      ],
      'event_type' =>
      [
        'api_name' => 'event_type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of Event. Possible values: links | videos | form',
        'default' => 'None',
      ],
      'goal_event_filter' =>
      [
        'api_name' => 'goal_event_filter',
        'type' => 'string',
        'required' => false,
        'description' => 'Goal will be met if. Possible values: any | all',
        'default' => 'any',
      ],
      'event_links' =>
      [
        'api_name' => 'event_links',
        'type' => 'string',
        'required' => false,
        'description' => 'The Event Links. Possible values: (Link]',
        'default' => 'None',
      ],
      'event_videos' =>
      [
        'api_name' => 'event_videos',
        'type' => 'integer',
        'required' => false,
        'description' => 'links of embedded video. Possible values: (Links] Allow Multiple: yes',
        'default' => 'yes',
      ],
      'form_identity_type' =>
      [
        'api_name' => 'form_identity_type',
        'type' => 'string',
        'required' => false,
        'description' => 'Form catch by Possible values: id | name',
        'default' => 'id',
      ],
      'form_identity' =>
      [
        'api_name' => 'form_identity',
        'type' => 'string',
        'required' => false,
        'description' => 'The Form identity. Possible values: (Text]',
        'default' => 'None',
      ],
    ],
  ],
  'goal_edit' =>
  [
    'slug' => 'vbout_goal_edit',
    'class' => 'VboutGoalEdit',
    'method' => 'POST',
    'path' => 'Goal/Edit',
    'type' => 'write',
    'name' => 'Goal Edit',
    'description' => 'Call the VBOUT Goal Edit endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the goal. Possible values: (ID]',
        'default' => 'None',
      ],
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the goal. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the goal. Possible values: url | duration | pages | ppc | event | funnel',
        'default' => 'url',
      ],
      'value_type' =>
      [
        'api_name' => 'value_type',
        'type' => 'string',
        'required' => false,
        'description' => 'Goal Value Type. Possible values: fixed | variable',
        'default' => 'fixed',
      ],
      'value' =>
      [
        'api_name' => 'value',
        'type' => 'string',
        'required' => false,
        'description' => 'Goal Value if the value type is fixed. Possible values: (Number]',
        'default' => '0',
      ],
      'destination_url' =>
      [
        'api_name' => 'destination_url',
        'type' => 'string',
        'required' => false,
        'description' => 'The Destination URL. Possible values: (Link]',
        'default' => 'None',
      ],
      'duration_hours' =>
      [
        'api_name' => 'duration_hours',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Hours. Possible values: (Number]',
        'default' => '0',
      ],
      'duration_minutes' =>
      [
        'api_name' => 'duration_minutes',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Minutes. Possible values: (Number]',
        'default' => '0',
      ],
      'duration_seconds' =>
      [
        'api_name' => 'duration_seconds',
        'type' => 'number',
        'required' => false,
        'description' => 'The Duration Number of Minutes. Possible values: (Number]',
        'default' => '0',
      ],
      'pages' =>
      [
        'api_name' => 'pages',
        'type' => 'number',
        'required' => false,
        'description' => 'The Number of Pages. Possible values: (Number]',
        'default' => '0',
      ],
      'ppc_networks' =>
      [
        'api_name' => 'ppc_networks',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of Referral Networks. Possible values: google | bing | facebook | twitter | linkedin',
        'default' => 'None',
      ],
      'event_type' =>
      [
        'api_name' => 'event_type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of Event. Possible values: links | videos | form',
        'default' => 'None',
      ],
      'goal_event_filter' =>
      [
        'api_name' => 'goal_event_filter',
        'type' => 'string',
        'required' => false,
        'description' => 'Goal will be met if. Possible values: any | all | all',
        'default' => 'Any',
      ],
      'event_links' =>
      [
        'api_name' => 'event_links',
        'type' => 'string',
        'required' => false,
        'description' => 'The Event Links. Possible values: Link',
        'default' => 'None',
      ],
      'event_videos' =>
      [
        'api_name' => 'event_videos',
        'type' => 'string',
        'required' => false,
        'description' => 'links of embedded video. Allow multiple: yes Possible values: (Links]',
        'default' => 'None',
      ],
      'form_identity_type' =>
      [
        'api_name' => 'form_identity_type',
        'type' => 'string',
        'required' => false,
        'description' => 'Form catch by. Possible values: id | name',
        'default' => 'id',
      ],
      'form_identity' =>
      [
        'api_name' => 'form_identity',
        'type' => 'string',
        'required' => false,
        'description' => 'The Form identity. Possible values: (Text]',
        'default' => 'None',
      ],
    ],
  ],
  'goal_delete' =>
  [
    'slug' => 'vbout_goal_delete',
    'class' => 'VboutGoalDelete',
    'method' => 'DELETE',
    'path' => 'Goal/Delete',
    'type' => 'write',
    'name' => 'Goal Delete',
    'description' => 'Call the VBOUT Goal Delete endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'web_hook_lists' =>
  [
    'slug' => 'vbout_web_hook_lists',
    'class' => 'VboutWebHookLists',
    'method' => 'GET',
    'path' => 'WebHook/lists',
    'type' => 'read',
    'name' => 'Web Hook lists',
    'description' => 'Call the VBOUT Web Hook lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'webhook_show' =>
  [
    'slug' => 'vbout_webhook_show',
    'class' => 'VboutWebhookShow',
    'method' => 'GET',
    'path' => 'Webhook/show',
    'type' => 'read',
    'name' => 'Webhook Show',
    'description' => 'Call the VBOUT Webhook Show endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the webhook. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'webhook_add' =>
  [
    'slug' => 'vbout_webhook_add',
    'class' => 'VboutWebhookAdd',
    'method' => 'POST',
    'path' => 'Webhook/Add',
    'type' => 'write',
    'name' => 'Webhook Add',
    'description' => 'Call the VBOUT Webhook Add endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the Popup. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the Popup. Possible values: page_exit | page_entry | goal_trigger',
        'default' => 'page_exit',
      ],
      'domain_id' =>
      [
        'api_name' => 'domainid',
        'type' => 'integer',
        'required' => false,
        'description' => 'The Domain id of the Popup. Possible values: (ID]',
        'default' => 'None',
      ],
      'action_url' =>
      [
        'api_name' => 'action_url',
        'type' => 'string',
        'required' => false,
        'description' => 'Page Url. Possible values: (Text]',
        'default' => 'None',
      ],
      'action_type' =>
      [
        'api_name' => 'action_type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the action. Possible values: html_msg | form | poll | redirection | trigger_js',
        'default' => 'html_msg',
      ],
      'redirection_url' =>
      [
        'api_name' => 'redirection_url',
        'type' => 'string',
        'required' => false,
        'description' => 'Redirection URL. Possible values: (Link]',
        'default' => 'None',
      ],
      'list_id' =>
      [
        'api_name' => 'list_id',
        'type' => 'integer',
        'required' => false,
        'description' => 'The List ID. Possible values: (ID]',
        'default' => 'None',
      ],
      'poll_question' =>
      [
        'api_name' => 'poll_question',
        'type' => 'string',
        'required' => false,
        'description' => 'The Polling Question. Possible values: (Text]',
        'default' => 'None',
      ],
      'poll_choices' =>
      [
        'api_name' => 'poll_choices',
        'type' => 'string',
        'required' => false,
        'description' => 'The polling Choices. Possible values: (Text] Allow multiple: yes',
        'default' => 'None',
      ],
      'js_code' =>
      [
        'api_name' => 'js_code',
        'type' => 'string',
        'required' => false,
        'description' => 'The Javascript Code. Possible values: (Text]',
        'default' => 'None',
      ],
      'action_startdate' =>
      [
        'api_name' => 'action_startdate',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Trigger Start Date. Possible values: (Date]',
        'default' => 'None',
      ],
      'action_enddate' =>
      [
        'api_name' => 'action_enddate',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Trigger End Date. Possible values: (Date]',
        'default' => 'None',
      ],
      'action_targetusers' =>
      [
        'api_name' => 'action_targetusers',
        'type' => 'string',
        'required' => false,
        'description' => 'The Target Users. Possible values: all | subscribers | anonymous',
        'default' => 'all',
      ],
      'action_devicefilter' =>
      [
        'api_name' => 'action_devicefilter',
        'type' => 'string',
        'required' => false,
        'description' => 'The Device Filter. Possible values: all | desktop | mobile',
        'default' => 'all',
      ],
      'action_ppcfilter' =>
      [
        'api_name' => 'action_ppcfilter',
        'type' => 'string',
        'required' => false,
        'description' => 'The PPC Referral Network Filter. Possible values: google | bing | facebook | twitter | linkedin',
        'default' => 'None',
      ],
      'action_geofilter' =>
      [
        'api_name' => 'action_geofilter',
        'type' => 'string',
        'required' => false,
        'description' => 'The Geo-Location Filter. Possible values: (Text] Allow Multiple: yes',
        'default' => 'None',
      ],
      'action_frequency' =>
      [
        'api_name' => 'action_frequency',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Frequency. Possible values: repeat | one_time',
        'default' => 'repeat',
      ],
      'delay_hours' =>
      [
        'api_name' => 'delay_hours',
        'type' => 'number',
        'required' => false,
        'description' => 'The Delay Number of Hours. Possible values: (Number]',
        'default' => '0',
      ],
      'delay_minutes' =>
      [
        'api_name' => 'delay_minutes',
        'type' => 'number',
        'required' => false,
        'description' => 'The Delay Number of Minutes. Possible values: (Number]',
        'default' => '0',
      ],
      'delay_seconds' =>
      [
        'api_name' => 'delay_seconds',
        'type' => 'number',
        'required' => false,
        'description' => 'The Delay Number of Seconds. Possible values: (Number]',
        'default' => '0',
      ],
      'action_style' =>
      [
        'api_name' => 'action_style',
        'type' => 'string',
        'required' => false,
        'description' => 'Choose Action Style. Possible values: popup | sticky_bar',
        'default' => 'popup',
      ],
      'action_text' =>
      [
        'api_name' => 'action_text',
        'type' => 'string',
        'required' => false,
        'description' => 'Action Text. Possible values: (Text]',
        'default' => 'None',
      ],
    ],
  ],
  'webhook_edit' =>
  [
    'slug' => 'vbout_webhook_edit',
    'class' => 'VboutWebhookEdit',
    'method' => 'POST',
    'path' => 'Webhook/Edit',
    'type' => 'write',
    'name' => 'Webhook Edit',
    'description' => 'Call the VBOUT Webhook Edit endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the Popup. Possible values: (Text]',
        'default' => 'None',
      ],
      'type' =>
      [
        'api_name' => 'type',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of the Popup. Possible values: page_exit | page_entry | goal_trigger',
        'default' => 'page_exit',
      ],
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Popup. Possible values: (ID]',
        'default' => 'None',
      ],
      'action_url' =>
      [
        'api_name' => 'action_url',
        'type' => 'string',
        'required' => false,
        'description' => 'Page Url. Possible values: (Link]',
        'default' => 'None',
      ],
      'action_type' =>
      [
        'api_name' => 'action_type',
        'type' => 'string',
        'required' => false,
        'description' => 'The type of the action. Possible values: html_msg | form | poll | redirection | trigger_js',
        'default' => 'html_msg',
      ],
      'redirection_url' =>
      [
        'api_name' => 'redirection_url',
        'type' => 'string',
        'required' => false,
        'description' => 'Redirection URL. Possible values: (Link]',
        'default' => 'None',
      ],
      'list_id' =>
      [
        'api_name' => 'list_id',
        'type' => 'string',
        'required' => false,
        'description' => 'The List ID. Possible values: (ID]',
        'default' => 'None',
      ],
      'poll_question' =>
      [
        'api_name' => 'poll_question',
        'type' => 'string',
        'required' => false,
        'description' => 'The Polling Question. Possible values: (Text]',
        'default' => 'None',
      ],
      'poll_choices' =>
      [
        'api_name' => 'poll_choices',
        'type' => 'string',
        'required' => false,
        'description' => 'The polling Choices. Possible values: (Text] Allow multiple: Yes',
        'default' => 'None',
      ],
      'js_code' =>
      [
        'api_name' => 'js_code',
        'type' => 'string',
        'required' => false,
        'description' => 'The Javascript Code. Possible values: (Text]',
        'default' => 'None',
      ],
      'action_startdate' =>
      [
        'api_name' => 'action_startdate',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Trigger Start Date. Possible values: (Date]',
        'default' => 'None',
      ],
      'action_enddate' =>
      [
        'api_name' => 'action_enddate',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Trigger End Date. Possible values: (Date]',
        'default' => 'None',
      ],
      'action_targetusers' =>
      [
        'api_name' => 'action_targetusers',
        'type' => 'string',
        'required' => false,
        'description' => 'The Target Users. Possible values: all | subscribers | anonymous',
        'default' => 'all',
      ],
      'action_devicefilter' =>
      [
        'api_name' => 'action_devicefilter',
        'type' => 'string',
        'required' => false,
        'description' => 'The Device Filter. Possible values: all | desktop | mobile',
        'default' => 'all',
      ],
      'action_ppcfilter' =>
      [
        'api_name' => 'action_ppcfilter',
        'type' => 'string',
        'required' => false,
        'description' => 'The PPC Referral Network Filter. Possible values: google | bing | facebook | twitter | linkedin',
        'default' => 'None',
      ],
      'action_geofilter' =>
      [
        'api_name' => 'action_geofilter',
        'type' => 'string',
        'required' => false,
        'description' => 'action_geofilter Possible values: (Text] Allow multiple: Yes',
        'default' => 'None',
      ],
      'action_frequency' =>
      [
        'api_name' => 'action_frequency',
        'type' => 'string',
        'required' => false,
        'description' => 'The Action Frequency. Possible values: repeat | one_time',
        'default' => 'repeat',
      ],
      'delay_hours' =>
      [
        'api_name' => 'delay_hours',
        'type' => 'string',
        'required' => false,
        'description' => 'The Delay Number of Hours. Possible values: (Number]',
        'default' => 'Number',
      ],
      'delay_minutes' =>
      [
        'api_name' => 'delay_minutes',
        'type' => 'string',
        'required' => false,
        'description' => 'The Delay Number of Minutes. Possible values: (Number]',
        'default' => 'Number',
      ],
      'delay_seconds' =>
      [
        'api_name' => 'delay_seconds',
        'type' => 'string',
        'required' => false,
        'description' => 'The Delay Number of Seconds. Possible values: (Number]',
        'default' => 'Number',
      ],
      'action_style' =>
      [
        'api_name' => 'action_style',
        'type' => 'string',
        'required' => false,
        'description' => 'Choose Action Style Possible values: popup | sticky_bar',
        'default' => 'popup',
      ],
      'action_text' =>
      [
        'api_name' => 'action_text',
        'type' => 'string',
        'required' => false,
        'description' => 'Action Text. Possible values: (Text]',
        'default' => 'None',
      ],
    ],
  ],
  'webhook_delete' =>
  [
    'slug' => 'vbout_webhook_delete',
    'class' => 'VboutWebhookDelete',
    'method' => 'DELETE',
    'path' => 'Webhook/Delete',
    'type' => 'write',
    'name' => 'Webhook Delete',
    'description' => 'Call the VBOUT Webhook Delete endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the Popup to delete. Possible values: (ID]',
        'default' => 'None',
      ],
    ],
  ],
  'register_create_account' =>
  [
    'slug' => 'vbout_register_create_account',
    'class' => 'VboutRegisterCreateAccount',
    'method' => 'POST',
    'path' => 'Register/CreateAccount',
    'type' => 'write',
    'name' => 'Register Create Account',
    'description' => 'Call the VBOUT Register Create Account endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'contact_name' =>
      [
        'api_name' => 'contact_name',
        'type' => 'string',
        'required' => true,
        'description' => 'The contact name. Possible values: (Text]',
        'default' => 'None',
      ],
      'business_name' =>
      [
        'api_name' => 'business_name',
        'type' => 'string',
        'required' => true,
        'description' => 'The business name. Possible values: (Text]',
        'default' => 'None',
      ],
      'business_email' =>
      [
        'api_name' => 'business_email',
        'type' => 'string',
        'required' => true,
        'description' => 'The business email. Possible values: (Email]',
        'default' => 'None',
      ],
      'business_phone' =>
      [
        'api_name' => 'business_phone',
        'type' => 'string',
        'required' => true,
        'description' => 'The business phone. Possible values: (Text]',
        'default' => 'None',
      ],
      'business_vbout_name' =>
      [
        'api_name' => 'business_vbout_name',
        'type' => 'string',
        'required' => true,
        'description' => 'The business VBOUT name. Possible values: (Text]',
        'default' => 'None',
      ],
      'plan_id' =>
      [
        'api_name' => 'plan_id',
        'type' => 'number',
        'required' => true,
        'description' => 'The custom plan id. Possible values: (Number]',
        'default' => 'None',
      ],
      'business_password' =>
      [
        'api_name' => 'business_password',
        'type' => 'string',
        'required' => false,
        'description' => 'The business password. Possible values: (Text]',
        'default' => 'None',
      ],
      'business_vat_number' =>
      [
        'api_name' => 'business_vat_number',
        'type' => 'string',
        'required' => false,
        'description' => 'The business VAT number. Possible values: (Text]',
        'default' => 'None',
      ],
      'timezone' =>
      [
        'api_name' => 'timezone',
        'type' => 'string',
        'required' => false,
        'description' => 'The business timezone. Possible values: https://www.php.net/manual/en/timezones.php',
        'default' => 'America/New_York',
      ],
      'commission_structure' =>
      [
        'api_name' => 'commission_structure',
        'type' => 'integer',
        'required' => false,
        'description' => 'The commission structure. Possible values: (1: Discount to paid amount] | (2: Normal commission payout]',
        'default' => '1',
      ],
      'disable_billing_access' =>
      [
        'api_name' => 'disable_billing_access',
        'type' => 'integer',
        'required' => false,
        'description' => 'Disable Billing Access. Possible values: 0 | 1',
        'default' => '0',
      ],
      'disable_settings_access' =>
      [
        'api_name' => 'disable_settings_access',
        'type' => 'integer',
        'required' => false,
        'description' => 'Disable Settings Access. Possible values: 0 | 1',
        'default' => '0',
      ],
      'pay_on_signup' =>
      [
        'api_name' => 'pay_on_signup',
        'type' => 'integer',
        'required' => false,
        'description' => 'Pay using agency saved card on success signup, and save the card to the newly created account. Possible values: 0 | 1',
        'default' => '0',
      ],
    ],
  ],
  'account_get_sub_account_auto_login' =>
  [
    'slug' => 'vbout_account_get_sub_account_auto_login',
    'class' => 'VboutAccountGetSubAccountAutoLogin',
    'method' => 'POST',
    'path' => 'Account/GetSubAccountAutoLogin',
    'type' => 'write',
    'name' => 'Account Subscriber Account Auto Login',
    'description' => 'Call the VBOUT Account Subscriber Account Auto Login endpoint. Authentication: Required Response Formats: XML | JSON Note: It should work with Agencies only.',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'id',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the sub-account. Possible values: (ID]',
        'default' => 'None',
      ],
      'expire' =>
      [
        'api_name' => 'expire',
        'type' => 'integer',
        'required' => false,
        'description' => 'the number of seconds that the returned auto-login url will remain valid before it expire (MAX 3600 Seconds]. Possible values: 1800',
        'default' => 3600,
      ],
    ],
  ],
  'settings_custom_shortcodes' =>
  [
    'slug' => 'vbout_settings_custom_shortcodes',
    'class' => 'VboutSettingsCustomShortcodes',
    'method' => 'GET',
    'path' => 'Settings/CustomShortcodes',
    'type' => 'read',
    'name' => 'Settings Custom Short codes',
    'description' => 'Call the VBOUT Settings Custom Short codes endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None',
    'parameters' =>
    [
    ],
  ],
  'settings_add_custom_shortcode' =>
  [
    'slug' => 'vbout_settings_add_custom_shortcode',
    'class' => 'VboutSettingsAddCustomShortcode',
    'method' => 'POST',
    'path' => 'Settings/AddCustomShortcode',
    'type' => 'write',
    'name' => 'Settings Add Custom Short Code',
    'description' => 'Call the VBOUT Settings Add Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'content' =>
      [
        'api_name' => 'Content',
        'type' => 'string',
        'required' => true,
        'description' => 'The content of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
      'name' =>
      [
        'api_name' => 'Name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
      'title' =>
      [
        'api_name' => 'Title',
        'type' => 'string',
        'required' => true,
        'description' => 'The title of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
    ],
  ],
  'settings_edit_custom_short_code' =>
  [
    'slug' => 'vbout_settings_edit_custom_short_code',
    'class' => 'VboutSettingsEditCustomShortCode',
    'method' => 'POST',
    'path' => 'Settings/EditCustomShortCode',
    'type' => 'write',
    'name' => 'Settings Edit Custom Short Code',
    'description' => 'Call the VBOUT Settings Edit Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'ID',
        'type' => 'number',
        'required' => true,
        'description' => 'The id of the short code. Possible values: (ID]',
        'default' => 'none',
      ],
      'title' =>
      [
        'api_name' => 'Title',
        'type' => 'string',
        'required' => true,
        'description' => 'The title of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
      'name' =>
      [
        'api_name' => 'Name',
        'type' => 'string',
        'required' => true,
        'description' => 'The name of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
      'content' =>
      [
        'api_name' => 'Content',
        'type' => 'string',
        'required' => true,
        'description' => 'The content of the short code. Possible values: (Text]',
        'default' => 'none',
      ],
    ],
  ],
  'settings_delete_custom_shortcode' =>
  [
    'slug' => 'vbout_settings_delete_custom_shortcode',
    'class' => 'VboutSettingsDeleteCustomShortcode',
    'method' => 'DELETE',
    'path' => 'Settings/DeleteCustomShortcode',
    'type' => 'write',
    'name' => 'Settings Delete Custom Short Code',
    'description' => 'Call the VBOUT Settings Delete Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'id' =>
      [
        'api_name' => 'ID',
        'type' => 'number',
        'required' => true,
        'description' => 'The id of the short code. Possible values: (ID]',
        'default' => 'none',
      ],
    ],
  ],
  'email_marketing_get_email_templates' =>
  [
    'slug' => 'vbout_email_marketing_get_email_templates',
    'class' => 'VboutEmailMarketingGetEmailTemplates',
    'method' => 'GET',
    'path' => 'EmailMarketing/GetEmailTemplates',
    'type' => 'read',
    'name' => 'Email Marketing Get Email Templates',
    'description' => 'Call the VBOUT Email Marketing Get Email Templates endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'automation_get_guides' =>
  [
    'slug' => 'vbout_automation_get_guides',
    'class' => 'VboutAutomationGetGuides',
    'method' => 'GET',
    'path' => 'Automation/GetGuides',
    'type' => 'read',
    'name' => 'Automation Get Guides',
    'description' => 'Call the VBOUT Automation Get Guides endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'automation_create_automation_from_guide' =>
  [
    'slug' => 'vbout_automation_create_automation_from_guide',
    'class' => 'VboutAutomationCreateAutomationFromGuide',
    'method' => 'POST',
    'path' => 'Automation/CreateAutomationFromGuide',
    'type' => 'write',
    'name' => 'Automation Create Automation From Guide',
    'description' => 'Call the VBOUT Automation Create Automation From Guide endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'pipeline_get_board_guide_categories' =>
  [
    'slug' => 'vbout_pipeline_get_board_guide_categories',
    'class' => 'VboutPipelineGetBoardGuideCategories',
    'method' => 'GET',
    'path' => 'Pipeline/GetBoardGuideCategories',
    'type' => 'read',
    'name' => 'Pipeline Get Board Guide Categories',
    'description' => 'Call the VBOUT Pipeline Get Board Guide Categories endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'pipeline_get_board_guides' =>
  [
    'slug' => 'vbout_pipeline_get_board_guides',
    'class' => 'VboutPipelineGetBoardGuides',
    'method' => 'GET',
    'path' => 'Pipeline/GetBoardGuides',
    'type' => 'read',
    'name' => 'Pipeline Get Board Guides',
    'description' => 'Call the VBOUT Pipeline Get Board Guides endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'pipeline_create_board_from_guide' =>
  [
    'slug' => 'vbout_pipeline_create_board_from_guide',
    'class' => 'VboutPipelineCreateBoardFromGuide',
    'method' => 'POST',
    'path' => 'Pipeline/CreateBoardFromGuide',
    'type' => 'write',
    'name' => 'Pipeline Create Board From Guide',
    'description' => 'Call the VBOUT Pipeline Create Board From Guide endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'guide_id' =>
      [
        'api_name' => 'guideid',
        'type' => 'integer',
        'required' => true,
        'description' => 'The guideid of the pipeline. Possible values: (ID]',
      ],
      'title' =>
      [
        'api_name' => 'Title',
        'type' => 'string',
        'required' => true,
        'description' => 'The Title of the pipeline. Possible values: (ID]',
      ],
    ],
  ],
  'aichatbot_aichatbottemplates' =>
  [
    'slug' => 'vbout_aichatbot_aichatbottemplates',
    'class' => 'VboutAIchatbotAichatbottemplates',
    'method' => 'GET',
    'path' => 'AIchatbot/aichatbottemplates',
    'type' => 'read',
    'name' => 'AIchatbot aichatbottemplates',
    'description' => 'Call the VBOUT AIchatbot aichatbottemplates endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'aichatbot_categories' =>
  [
    'slug' => 'vbout_aichatbot_categories',
    'class' => 'VboutAIchatbotCategories',
    'method' => 'GET',
    'path' => 'AIchatbot/categories',
    'type' => 'read',
    'name' => 'AIchatbot categories',
    'description' => 'Call the VBOUT AIchatbot categories endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'aichatbot_tags' =>
  [
    'slug' => 'vbout_aichatbot_tags',
    'class' => 'VboutAIchatbotTags',
    'method' => 'GET',
    'path' => 'AIchatbot/tags',
    'type' => 'read',
    'name' => 'AIchatbot tags',
    'description' => 'Call the VBOUT AIchatbot tags endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
    ],
  ],
  'aichatbot_copy' =>
  [
    'slug' => 'vbout_aichatbot_copy',
    'class' => 'VboutAIchatbotCopy',
    'method' => 'POST',
    'path' => 'AIchatbot/copy',
    'type' => 'write',
    'name' => 'AIchatbot copy',
    'description' => 'Call the VBOUT AIchatbot copy endpoint. Authentication: Required Response Formats: XML | JSON',
    'parameters' =>
    [
      'template_id' =>
      [
        'api_name' => 'template_id',
        'type' => 'number',
        'required' => true,
        'description' => 'The template_id from index. Possible values: (ID]',
      ],
      'name' =>
      [
        'api_name' => 'name',
        'type' => 'string',
        'required' => false,
        'description' => 'The Custom name of the chatbot. Possible values: (ID]',
      ],
    ],
  ],
];

    /**
     * @param  string  $apiKey  VBOUT API user key.
     * @param  string  $baseUrl  VBOUT API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.vbout.com/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Return the official VBOUT operation catalog used by tools and docs.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Execute an operation from the official VBOUT operation catalog.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $args  Tool arguments keyed by normalized parameter name.
     * @return array<string, mixed>
     */
    public function executeOperation(string $operation, array $args = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported VBOUT operation: {$operation}");
        }

        $params = [];
        foreach ($definition['parameters'] as $name => $parameter) {
            $value = $args[$name] ?? null;
            if (($value === null || $value === '') && isset($parameter['default']) && $parameter['default'] !== 'None' && $parameter['default'] !== 'none' && $parameter['default'] !== 'Null') {
                $value = $parameter['default'];
            }

            if (($value === null || $value === '') && ($parameter['required'] ?? false)) {
                throw new RuntimeException("Missing required VBOUT parameter: {$name}");
            }

            if ($value !== null && $value !== '') {
                $params[(string) $parameter['api_name']] = $value;
            }
        }

        return $this->request((string) $definition['method'], (string) $definition['path'], $params);
    }

    /**
     * List contacts from a VBOUT email list.
     *
     * @param  int|string  $listId  The VBOUT list identifier.
     * @return array<string, mixed>
     */
    public function listContacts(int|string $listId): array
    {
        return $this->executeOperation('email_marketing_get_contacts', ['list_id' => $listId]);
    }

    /**
     * Get a single VBOUT contact by ID.
     *
     * @param  int|string  $id  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(int|string $id): array
    {
        return $this->executeOperation('email_marketing_get_contact', ['id' => $id]);
    }

    /**
     * Add a contact to a VBOUT list.
     *
     * @param  string  $email  Contact email address.
     * @param  int|string  $listId  VBOUT list identifier.
     * @param  array<string, mixed>  $extra  Additional official contact parameters.
     * @return array<string, mixed>
     */
    public function createContact(string $email, int|string $listId, array $extra = []): array
    {
        return $this->executeOperation('email_marketing_add_contact', array_merge(['email' => $email, 'list_id' => $listId], $extra));
    }

    /**
     * List VBOUT email campaigns.
     *
     * @param  array<string, mixed>  $params  Campaign filters such as filter, from, to, limit, or page.
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->executeOperation('email_marketing_campaigns', $params + ['filter' => 'all']);
    }

    /**
     * Get a single VBOUT campaign by ID.
     *
     * @param  int|string  $id  The campaign identifier.
     * @param  string|null  $type  Campaign type, such as standard or automated.
     * @return array<string, mixed>
     */
    public function getCampaign(int|string $id, ?string $type = null): array
    {
        return $this->executeOperation('email_marketing_get_campaign', array_filter(['id' => $id, 'type' => $type], static fn ($value) => $value !== null));
    }

    /**
     * Get the authenticated VBOUT account profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->executeOperation('app_me');
    }

    /**
     * Make an authenticated VBOUT API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Official VBOUT endpoint path.
     * @param  array<string, mixed>  $data  Request query parameters.
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw authenticated VBOUT request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Official VBOUT endpoint path.
     * @param  array<string, mixed>  $data  Request query parameters.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('VBOUT API key is not configured.');
        }

        $url = $this->baseUrl.'/'.ltrim($path, '/');
        $query = ['key' => $this->apiKey] + $this->normalizeQuery($data);

        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->timeout(30)
                ->send(strtoupper($method), $url, ['query' => $query]);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();
                $error = $response->json('error') ?? $response->json('message') ?? $body;

                Log::error("VBOUT API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'content_type' => $contentType,
                    'error' => $error,
                ]);

                throw new RuntimeException('VBOUT API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("VBOUT API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to VBOUT API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize arrays and booleans for VBOUT query-style endpoints.
     *
     * @param  array<string, mixed>  $data  Request parameters.
     * @return array<string, mixed>
     */
    private function normalizeQuery(array $data): array
    {
        $normalized = [];
        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $normalized[$key] = $value ? 'true' : 'false';
                continue;
            }

            if (is_array($value) && array_is_list($value)) {
                $normalized[$key] = implode(',', array_map(static fn ($item): string => (string) $item, $value));
                continue;
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }
}
