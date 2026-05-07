<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Add an internal comment to a Front conversation.
 */
class FrontAddComment extends AbstractFrontTool
{
    protected const NAME = 'front_add_comment';
    protected const DESCRIPTION = 'Add a comment to a Front conversation. Multipart attachments are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/conversations/{conversation_id}/comments';
    protected const REQUIRED = ['conversation_id', 'body'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['author_id', 'body', 'is_pinned'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
        'body' => ['type' => 'string', 'required' => true, 'description' => 'Comment content. Markdown is supported by Front.'],
        'author_id' => ['type' => 'string', 'description' => 'Teammate ID or alias for the comment author.'],
        'is_pinned' => ['type' => 'boolean', 'description' => 'Whether the comment should be pinned.'],
    ];
}
