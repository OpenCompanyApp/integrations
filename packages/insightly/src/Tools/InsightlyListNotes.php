<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly notes.
 */
class InsightlyListNotes extends InsightlyListEvents
{
    protected string $toolName = 'insightly_list_notes';
    protected string $toolDescription = 'List notes from Insightly.';
    protected string $path = '/v3.1/Notes';
}
