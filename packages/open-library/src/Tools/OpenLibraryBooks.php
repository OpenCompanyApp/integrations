<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Look up books by legacy bibkeys.
 */
class OpenLibraryBooks extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_books';
    protected const DESCRIPTION = 'Look up one or more books by ISBN, LCCN, OCLC, or OLID bibkeys using the Open Library Books API.';
    protected const METHOD = 'books';
    protected const REQUIRED = ['bibkeys'];
    protected const PARAMETERS = [
        'bibkeys' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated bibkeys, such as ISBN:0451526538,LCCN:62019420,OLID:OL123M.'],
        'jscmd' => ['type' => 'string', 'required' => false, 'description' => 'Response command.', 'enum' => ['data', 'viewapi']],
    ];
}
