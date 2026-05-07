<?php

namespace OpenCompany\Integrations\DailyCo;

/**
 * Official Daily REST API operation metadata from the generated Daily Ruby SDK.
 *
 * Source: https://github.com/daily-co/daily-ruby
 */
class DailyCoOperations
{
    /**
     * Return all supported Daily REST API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'operation' => 'batch_room_create',
                'slug' => 'daily_co_batch_room_create',
                'class' => 'DailyCoBatchRoomCreate',
                'method' => 'POST',
                'path' => '/batch/rooms',
                'name' => 'Batch Room Create',
                'description' => 'Batch Room Create.

Official Daily REST API endpoint: POST https://api.daily.co/v1/batch/rooms (official Ruby SDK method: batch_room_create).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'batch_room_delete',
                'slug' => 'daily_co_batch_room_delete',
                'class' => 'DailyCoBatchRoomDelete',
                'method' => 'DELETE',
                'path' => '/batch/rooms',
                'name' => 'Batch Room Delete',
                'description' => 'Batch Room Delete.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/batch/rooms (official Ruby SDK method: batch_room_delete).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'buy_phone_number',
                'slug' => 'daily_co_buy_phone_number',
                'class' => 'DailyCoBuyPhoneNumber',
                'method' => 'POST',
                'path' => '/buy-phone-number',
                'name' => 'Buy Phone Number',
                'description' => 'Buy Phone Number.

Official Daily REST API endpoint: POST https://api.daily.co/v1/buy-phone-number (official Ruby SDK method: buy_phone_number).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'create_meeting_token',
                'slug' => 'daily_co_create_meeting_token',
                'class' => 'DailyCoCreateMeetingToken',
                'method' => 'POST',
                'path' => '/meeting-tokens',
                'name' => 'Create Meeting Token',
                'description' => 'Create Meeting Token.

Official Daily REST API endpoint: POST https://api.daily.co/v1/meeting-tokens (official Ruby SDK method: create_meeting_token).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'create_room',
                'slug' => 'daily_co_create_room',
                'class' => 'DailyCoCreateRoom',
                'method' => 'POST',
                'path' => '/rooms',
                'name' => 'Create Room',
                'description' => 'Create Room.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms (official Ruby SDK method: create_room).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'create_webhook',
                'slug' => 'daily_co_create_webhook',
                'class' => 'DailyCoCreateWebhook',
                'method' => 'POST',
                'path' => '/webhooks',
                'name' => 'Create Webhook',
                'description' => 'Create Webhook.

Official Daily REST API endpoint: POST https://api.daily.co/v1/webhooks (official Ruby SDK method: create_webhook).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'delete_recording',
                'slug' => 'daily_co_delete_recording',
                'class' => 'DailyCoDeleteRecording',
                'method' => 'DELETE',
                'path' => '/recordings/{recording_id}',
                'name' => 'Delete Recording',
                'description' => 'Delete Recording.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/recordings/{recording_id} (official Ruby SDK method: delete_recording).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'recording_id',
                        'param' => 'recording_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `recording_id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'delete_room',
                'slug' => 'daily_co_delete_room',
                'class' => 'DailyCoDeleteRoom',
                'method' => 'DELETE',
                'path' => '/rooms/{room_name}',
                'name' => 'Delete Room',
                'description' => 'Delete Room.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/rooms/{room_name} (official Ruby SDK method: delete_room).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'delete_transcript',
                'slug' => 'daily_co_delete_transcript',
                'class' => 'DailyCoDeleteTranscript',
                'method' => 'DELETE',
                'path' => '/transcript/{transcriptId}',
                'name' => 'Delete Transcript',
                'description' => 'Delete Transcript.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/transcript/{transcriptId} (official Ruby SDK method: delete_transcript).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'transcriptId',
                        'param' => 'transcript_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `transcriptId`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'delete_webhook',
                'slug' => 'daily_co_delete_webhook',
                'class' => 'DailyCoDeleteWebhook',
                'method' => 'DELETE',
                'path' => '/webhooks/{id}',
                'name' => 'Delete Webhook',
                'description' => 'Delete Webhook.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/webhooks/{id} (official Ruby SDK method: delete_webhook).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'param' => 'id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'eject',
                'slug' => 'daily_co_eject',
                'class' => 'DailyCoEject',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/eject',
                'name' => 'Eject',
                'description' => 'Eject.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/eject (official Ruby SDK method: eject).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'get_domain_config',
                'slug' => 'daily_co_get_domain_config',
                'class' => 'DailyCoGetDomainConfig',
                'method' => 'GET',
                'path' => '/',
                'name' => 'Get Domain Config',
                'description' => 'Get Domain Config.

Official Daily REST API endpoint: GET https://api.daily.co/v1/ (official Ruby SDK method: get_domain_config).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'get_individual_meeting_info',
                'slug' => 'daily_co_get_meeting',
                'class' => 'DailyCoGetMeeting',
                'method' => 'GET',
                'path' => '/meetings/{meeting}',
                'name' => 'Get Meeting',
                'description' => 'Get Meeting.

Official Daily REST API endpoint: GET https://api.daily.co/v1/meetings/{meeting} (official Ruby SDK method: get_individual_meeting_info).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'meeting',
                        'param' => 'meeting',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `meeting`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_meeting_participants',
                'slug' => 'daily_co_get_meeting_participants',
                'class' => 'DailyCoGetMeetingParticipants',
                'method' => 'GET',
                'path' => '/meetings/{meeting}/participants',
                'name' => 'Get Meeting Participants',
                'description' => 'Get Meeting Participants.

Official Daily REST API endpoint: GET https://api.daily.co/v1/meetings/{meeting}/participants (official Ruby SDK method: get_meeting_participants).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'meeting',
                        'param' => 'meeting',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `meeting`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_presence',
                'slug' => 'daily_co_get_presence',
                'class' => 'DailyCoGetPresence',
                'method' => 'GET',
                'path' => '/presence',
                'name' => 'Get Presence',
                'description' => 'Get Presence.

Official Daily REST API endpoint: GET https://api.daily.co/v1/presence (official Ruby SDK method: get_presence).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'get_recording_info',
                'slug' => 'daily_co_get_recording_info',
                'class' => 'DailyCoGetRecordingInfo',
                'method' => 'GET',
                'path' => '/recordings/{recording_id}',
                'name' => 'Get Recording Info',
                'description' => 'Get Recording Info.

Official Daily REST API endpoint: GET https://api.daily.co/v1/recordings/{recording_id} (official Ruby SDK method: get_recording_info).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'recording_id',
                        'param' => 'recording_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `recording_id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_recording_link',
                'slug' => 'daily_co_get_recording_link',
                'class' => 'DailyCoGetRecordingLink',
                'method' => 'GET',
                'path' => '/recordings/{recording_id}/access-link',
                'name' => 'Get Recording Link',
                'description' => 'Get Recording Link.

Official Daily REST API endpoint: GET https://api.daily.co/v1/recordings/{recording_id}/access-link (official Ruby SDK method: get_recording_link).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'recording_id',
                        'param' => 'recording_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `recording_id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_room_config',
                'slug' => 'daily_co_get_room',
                'class' => 'DailyCoGetRoom',
                'method' => 'GET',
                'path' => '/rooms/{room_name}',
                'name' => 'Get Room',
                'description' => 'Get Room.

Official Daily REST API endpoint: GET https://api.daily.co/v1/rooms/{room_name} (official Ruby SDK method: get_room_config).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_room_presence',
                'slug' => 'daily_co_get_room_presence',
                'class' => 'DailyCoGetRoomPresence',
                'method' => 'GET',
                'path' => '/rooms/{room_name}/presence',
                'name' => 'Get Room Presence',
                'description' => 'Get Room Presence.

Official Daily REST API endpoint: GET https://api.daily.co/v1/rooms/{room_name}/presence (official Ruby SDK method: get_room_presence).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_session_data',
                'slug' => 'daily_co_get_session_data',
                'class' => 'DailyCoGetSessionData',
                'method' => 'GET',
                'path' => '/rooms/{room_name}/get-session-data',
                'name' => 'Get Session Data',
                'description' => 'Get Session Data.

Official Daily REST API endpoint: GET https://api.daily.co/v1/rooms/{room_name}/get-session-data (official Ruby SDK method: get_session_data).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_transcript_info',
                'slug' => 'daily_co_get_transcript_info',
                'class' => 'DailyCoGetTranscriptInfo',
                'method' => 'GET',
                'path' => '/transcript/{transcriptId}',
                'name' => 'Get Transcript Info',
                'description' => 'Get Transcript Info.

Official Daily REST API endpoint: GET https://api.daily.co/v1/transcript/{transcriptId} (official Ruby SDK method: get_transcript_info).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'transcriptId',
                        'param' => 'transcript_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `transcriptId`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_transcript_link',
                'slug' => 'daily_co_get_transcript_link',
                'class' => 'DailyCoGetTranscriptLink',
                'method' => 'GET',
                'path' => '/transcript/{transcriptId}/access-link',
                'name' => 'Get Transcript Link',
                'description' => 'Get Transcript Link.

Official Daily REST API endpoint: GET https://api.daily.co/v1/transcript/{transcriptId}/access-link (official Ruby SDK method: get_transcript_link).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'transcriptId',
                        'param' => 'transcript_id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `transcriptId`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'get_webhook_config',
                'slug' => 'daily_co_get_webhook_config',
                'class' => 'DailyCoGetWebhookConfig',
                'method' => 'GET',
                'path' => '/webhooks/{id}',
                'name' => 'Get Webhook Config',
                'description' => 'Get Webhook Config.

Official Daily REST API endpoint: GET https://api.daily.co/v1/webhooks/{id} (official Ruby SDK method: get_webhook_config).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'param' => 'id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'list_api_logs',
                'slug' => 'daily_co_list_api_logs',
                'class' => 'DailyCoListApiLogs',
                'method' => 'GET',
                'path' => '/logs/api',
                'name' => 'List API Logs',
                'description' => 'List API Logs.

Official Daily REST API endpoint: GET https://api.daily.co/v1/logs/api (official Ruby SDK method: list_api_logs).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'list_available_numbers',
                'slug' => 'daily_co_list_available_numbers',
                'class' => 'DailyCoListAvailableNumbers',
                'method' => 'GET',
                'path' => '/list-available-numbers',
                'name' => 'List Available Numbers',
                'description' => 'List Available Numbers.

Official Daily REST API endpoint: GET https://api.daily.co/v1/list-available-numbers (official Ruby SDK method: list_available_numbers).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'list_logs',
                'slug' => 'daily_co_list_logs',
                'class' => 'DailyCoListLogs',
                'method' => 'GET',
                'path' => '/logs',
                'name' => 'List Logs',
                'description' => 'List Logs.

Official Daily REST API endpoint: GET https://api.daily.co/v1/logs (official Ruby SDK method: list_logs).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'get_meeting_info',
                'slug' => 'daily_co_list_meetings',
                'class' => 'DailyCoListMeetings',
                'method' => 'GET',
                'path' => '/meetings',
                'name' => 'List Meetings',
                'description' => 'List Meetings.

Official Daily REST API endpoint: GET https://api.daily.co/v1/meetings (official Ruby SDK method: get_meeting_info).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'purchased_phone_nunbers',
                'slug' => 'daily_co_list_purchased_phone_numbers',
                'class' => 'DailyCoListPurchasedPhoneNumbers',
                'method' => 'GET',
                'path' => '/purchased-phone-numbers',
                'name' => 'List Purchased Phone Numbers',
                'description' => 'List Purchased Phone Numbers.

Official Daily REST API endpoint: GET https://api.daily.co/v1/purchased-phone-numbers (official Ruby SDK method: purchased_phone_nunbers).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'list_recordings',
                'slug' => 'daily_co_list_recordings',
                'class' => 'DailyCoListRecordings',
                'method' => 'GET',
                'path' => '/recordings',
                'name' => 'List Recordings',
                'description' => 'List Recordings.

Official Daily REST API endpoint: GET https://api.daily.co/v1/recordings (official Ruby SDK method: list_recordings).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'list_rooms',
                'slug' => 'daily_co_list_rooms',
                'class' => 'DailyCoListRooms',
                'method' => 'GET',
                'path' => '/rooms',
                'name' => 'List Rooms',
                'description' => 'List Rooms.

Official Daily REST API endpoint: GET https://api.daily.co/v1/rooms (official Ruby SDK method: list_rooms).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'list_transcript',
                'slug' => 'daily_co_list_transcripts',
                'class' => 'DailyCoListTranscripts',
                'method' => 'GET',
                'path' => '/transcript',
                'name' => 'List Transcripts',
                'description' => 'List Transcripts.

Official Daily REST API endpoint: GET https://api.daily.co/v1/transcript (official Ruby SDK method: list_transcript).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'get_webhooks',
                'slug' => 'daily_co_list_webhooks',
                'class' => 'DailyCoListWebhooks',
                'method' => 'GET',
                'path' => '/webhooks',
                'name' => 'List Webhooks',
                'description' => 'List Webhooks.

Official Daily REST API endpoint: GET https://api.daily.co/v1/webhooks (official Ruby SDK method: get_webhooks).',
                'type' => 'read',
                'parameters' => [],
                'request_body' => false,
            ],
            [
                'operation' => 'pinless_call_update',
                'slug' => 'daily_co_pinless_call_update',
                'class' => 'DailyCoPinlessCallUpdate',
                'method' => 'POST',
                'path' => '/dialin/pinlessCallUpdate',
                'name' => 'Pinless Call Update',
                'description' => 'Pinless Call Update.

Official Daily REST API endpoint: POST https://api.daily.co/v1/dialin/pinlessCallUpdate (official Ruby SDK method: pinless_call_update).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'release_phone_number',
                'slug' => 'daily_co_release_phone_number',
                'class' => 'DailyCoReleasePhoneNumber',
                'method' => 'DELETE',
                'path' => '/release-phone-number/{id}',
                'name' => 'Release Phone Number',
                'description' => 'Release Phone Number.

Official Daily REST API endpoint: DELETE https://api.daily.co/v1/release-phone-number/{id} (official Ruby SDK method: release_phone_number).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'param' => 'id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `id`.',
                    ],
                ],
                'request_body' => false,
            ],
            [
                'operation' => 'room_dial_out_send_dtmf',
                'slug' => 'daily_co_room_dial_out_send_dtmf',
                'class' => 'DailyCoRoomDialOutSendDtmf',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/dialOut/sendDTMF',
                'name' => 'Room Dial Out Send DTMF',
                'description' => 'Room Dial Out Send DTMF.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/dialOut/sendDTMF (official Ruby SDK method: room_dial_out_send_dtmf).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_dial_out_start',
                'slug' => 'daily_co_room_dial_out_start',
                'class' => 'DailyCoRoomDialOutStart',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/dialOut/start',
                'name' => 'Room Dial Out Start',
                'description' => 'Room Dial Out Start.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/dialOut/start (official Ruby SDK method: room_dial_out_start).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_dial_out_stop',
                'slug' => 'daily_co_room_dial_out_stop',
                'class' => 'DailyCoRoomDialOutStop',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/dialOut/stop',
                'name' => 'Room Dial Out Stop',
                'description' => 'Room Dial Out Stop.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/dialOut/stop (official Ruby SDK method: room_dial_out_stop).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_livestreaming_start',
                'slug' => 'daily_co_room_livestreaming_start',
                'class' => 'DailyCoRoomLivestreamingStart',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/live-streaming/start',
                'name' => 'Room Livestreaming Start',
                'description' => 'Room Livestreaming Start.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/live-streaming/start (official Ruby SDK method: room_livestreaming_start).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_livestreaming_stop',
                'slug' => 'daily_co_room_livestreaming_stop',
                'class' => 'DailyCoRoomLivestreamingStop',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/live-streaming/stop',
                'name' => 'Room Livestreaming Stop',
                'description' => 'Room Livestreaming Stop.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/live-streaming/stop (official Ruby SDK method: room_livestreaming_stop).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_livestreaming_update',
                'slug' => 'daily_co_room_livestreaming_update',
                'class' => 'DailyCoRoomLivestreamingUpdate',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/live-streaming/update',
                'name' => 'Room Livestreaming Update',
                'description' => 'Room Livestreaming Update.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/live-streaming/update (official Ruby SDK method: room_livestreaming_update).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_recordings_start',
                'slug' => 'daily_co_room_recordings_start',
                'class' => 'DailyCoRoomRecordingsStart',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/recordings/start',
                'name' => 'Room Recordings Start',
                'description' => 'Room Recordings Start.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/recordings/start (official Ruby SDK method: room_recordings_start).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_recordings_stop',
                'slug' => 'daily_co_room_recordings_stop',
                'class' => 'DailyCoRoomRecordingsStop',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/recordings/stop',
                'name' => 'Room Recordings Stop',
                'description' => 'Room Recordings Stop.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/recordings/stop (official Ruby SDK method: room_recordings_stop).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_recordings_update',
                'slug' => 'daily_co_room_recordings_update',
                'class' => 'DailyCoRoomRecordingsUpdate',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/recordings/update',
                'name' => 'Room Recordings Update',
                'description' => 'Room Recordings Update.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/recordings/update (official Ruby SDK method: room_recordings_update).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_sip_call_transfer',
                'slug' => 'daily_co_room_sip_call_transfer',
                'class' => 'DailyCoRoomSipCallTransfer',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/sipCallTransfer',
                'name' => 'Room Sip Call Transfer',
                'description' => 'Room Sip Call Transfer.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/sipCallTransfer (official Ruby SDK method: room_sip_call_transfer).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_sip_refer',
                'slug' => 'daily_co_room_sip_refer',
                'class' => 'DailyCoRoomSipRefer',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/sipRefer',
                'name' => 'Room Sip Refer',
                'description' => 'Room Sip Refer.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/sipRefer (official Ruby SDK method: room_sip_refer).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_transcription_start',
                'slug' => 'daily_co_room_transcription_start',
                'class' => 'DailyCoRoomTranscriptionStart',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/transcription/start',
                'name' => 'Room Transcription Start',
                'description' => 'Room Transcription Start.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/transcription/start (official Ruby SDK method: room_transcription_start).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'room_transcription_stop',
                'slug' => 'daily_co_room_transcription_stop',
                'class' => 'DailyCoRoomTranscriptionStop',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/transcription/stop',
                'name' => 'Room Transcription Stop',
                'description' => 'Room Transcription Stop.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/transcription/stop (official Ruby SDK method: room_transcription_stop).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'send_app_message',
                'slug' => 'daily_co_send_app_message',
                'class' => 'DailyCoSendAppMessage',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/send-app-message',
                'name' => 'Send App Message',
                'description' => 'Send App Message.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/send-app-message (official Ruby SDK method: send_app_message).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'set_domain_config',
                'slug' => 'daily_co_set_domain_config',
                'class' => 'DailyCoSetDomainConfig',
                'method' => 'POST',
                'path' => '/',
                'name' => 'Set Domain Config',
                'description' => 'Set Domain Config.

Official Daily REST API endpoint: POST https://api.daily.co/v1/ (official Ruby SDK method: set_domain_config).',
                'type' => 'write',
                'parameters' => [],
                'request_body' => true,
            ],
            [
                'operation' => 'set_room_config',
                'slug' => 'daily_co_set_room_config',
                'class' => 'DailyCoSetRoomConfig',
                'method' => 'POST',
                'path' => '/rooms/{room_name}',
                'name' => 'Set Room Config',
                'description' => 'Set Room Config.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name} (official Ruby SDK method: set_room_config).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'set_session_data',
                'slug' => 'daily_co_set_session_data',
                'class' => 'DailyCoSetSessionData',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/set-session-data',
                'name' => 'Set Session Data',
                'description' => 'Set Session Data.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/set-session-data (official Ruby SDK method: set_session_data).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'update_permissions',
                'slug' => 'daily_co_update_permissions',
                'class' => 'DailyCoUpdatePermissions',
                'method' => 'POST',
                'path' => '/rooms/{room_name}/update-permissions',
                'name' => 'Update Permissions',
                'description' => 'Update Permissions.

Official Daily REST API endpoint: POST https://api.daily.co/v1/rooms/{room_name}/update-permissions (official Ruby SDK method: update_permissions).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'room_name',
                        'param' => 'room_name',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `room_name`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'update_webhook_config',
                'slug' => 'daily_co_update_webhook_config',
                'class' => 'DailyCoUpdateWebhookConfig',
                'method' => 'POST',
                'path' => '/webhooks/{id}',
                'name' => 'Update Webhook Config',
                'description' => 'Update Webhook Config.

Official Daily REST API endpoint: POST https://api.daily.co/v1/webhooks/{id} (official Ruby SDK method: update_webhook_config).',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'param' => 'id',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `id`.',
                    ],
                ],
                'request_body' => true,
            ],
            [
                'operation' => 'validate_meeting_token',
                'slug' => 'daily_co_validate_meeting_token',
                'class' => 'DailyCoValidateMeetingToken',
                'method' => 'GET',
                'path' => '/meeting-tokens/{meeting_token}',
                'name' => 'Validate Meeting Token',
                'description' => 'Validate Meeting Token.

Official Daily REST API endpoint: GET https://api.daily.co/v1/meeting-tokens/{meeting_token} (official Ruby SDK method: validate_meeting_token).',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'meeting_token',
                        'param' => 'meeting_token',
                        'in' => 'path',
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Daily path parameter `meeting_token`.',
                    ],
                ],
                'request_body' => false,
            ],
        ];
    }
}
