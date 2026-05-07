<?php

namespace OpenCompany\Integrations\Crisp\Tools;

/**
 * Mark Conversation As Unread using the official Crisp REST API.
 */
class CrispMarkConversationAsUnread extends AbstractCrispOperationTool
{
    protected const OPERATION = 'mark_conversation_as_unread';
}
