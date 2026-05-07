<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * List works by an author.
 */
class OpenLibraryAuthorWorks extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_author_works';
    protected const DESCRIPTION = 'List works by an Open Library author.';
    protected const METHOD = 'authorWorks';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Open Library author ID.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum works.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Work offset.'],
    ];
}
