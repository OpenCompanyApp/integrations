<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Create an Attio note. */
class AttioCreateNote extends AbstractAttioTool
{
    protected const NAME = 'attio_create_note';
    protected const DESCRIPTION = 'Create a note in Attio, optionally attached to records through tags.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/notes';
    protected const BODY_KEYS = ['title', 'content_plaintext', 'content_markdown', 'tags'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'title' => ['type' => 'string', 'description' => 'Note title.'],
        'content_plaintext' => ['type' => 'string', 'description' => 'Plain text note content.'],
        'content_markdown' => ['type' => 'string', 'description' => 'Markdown note content.'],
        'tags' => ['type' => 'array', 'description' => 'Note tags, including record tags when attaching to records.'],
        'body' => ['type' => 'object', 'description' => 'Raw note body. If data is omitted, fields are wrapped as data.'],
    ];
}
