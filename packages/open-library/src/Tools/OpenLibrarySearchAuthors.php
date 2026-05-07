<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Search Open Library authors.
 */
class OpenLibrarySearchAuthors extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_search_authors';
    protected const DESCRIPTION = 'Search Open Library authors by query.';
    protected const METHOD = 'searchAuthors';
    protected const REQUIRED = ['q'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Author search query.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
    ];
}
