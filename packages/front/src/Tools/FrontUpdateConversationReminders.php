<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Snooze or unsnooze a Front conversation for a teammate.
 */
class FrontUpdateConversationReminders extends AbstractFrontTool
{
    protected const NAME = 'front_update_conversation_reminders';
    protected const DESCRIPTION = 'Snooze or unsnooze a Front conversation for a teammate by updating its reminder.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/conversations/{conversation_id}/reminders';
    protected const REQUIRED = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['teammate_id', 'scheduled_at', 'status_id'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or alias for the reminder.'],
        'scheduled_at' => ['type' => 'number', 'required' => true, 'description' => 'Unix timestamp in seconds. Use body to send null and cancel.'],
        'status_id' => ['type' => 'string', 'description' => 'Optional waiting status ID for ticketing.'],
        'body' => ['type' => 'object', 'description' => 'Optional raw reminder payload. Use this to send scheduled_at as null.'],
    ];
}
