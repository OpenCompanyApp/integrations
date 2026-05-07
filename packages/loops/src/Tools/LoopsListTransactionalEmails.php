<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * List published Loops transactional emails.
 *
 * Supports Loops cursor pagination.
 */
class LoopsListTransactionalEmails extends AbstractLoopsTool
{
    protected const NAME = 'loops_list_transactional_emails';
    protected const DESCRIPTION = 'List published Loops transactional emails with cursor pagination.';
    protected const METHOD = 'listTransactionalEmails';
    protected const PARAMETERS = [
        'perPage' => ['type' => 'integer', 'description' => 'Results per page. Loops requires 10 to 50.'],
        'cursor' => ['type' => 'string', 'description' => 'Cursor from pagination.nextCursor.'],
    ];
}
