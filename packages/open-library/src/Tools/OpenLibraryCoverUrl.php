<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Build an Open Library cover image URL.
 */
class OpenLibraryCoverUrl extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_cover_url';
    protected const DESCRIPTION = 'Build an Open Library Covers API image URL by ISBN, OLID, OCLC, LCCN, or cover ID.';
    protected const METHOD = 'coverUrl';
    protected const REQUIRED = ['type', 'value'];
    protected const PARAMETERS = [
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Identifier type.', 'enum' => ['isbn', 'olid', 'oclc', 'lccn', 'id']],
        'value' => ['type' => 'string', 'required' => true, 'description' => 'Identifier value.'],
        'size' => ['type' => 'string', 'required' => false, 'description' => 'Cover size.', 'enum' => ['S', 'M', 'L']],
    ];
}
