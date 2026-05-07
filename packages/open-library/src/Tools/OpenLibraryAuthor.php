<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve one Open Library author.
 */
class OpenLibraryAuthor extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_author';
    protected const DESCRIPTION = 'Retrieve one Open Library author by ID, such as OL23919A or /authors/OL23919A.';
    protected const METHOD = 'author';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = ['id' => ['type' => 'string', 'required' => true, 'description' => 'Open Library author ID.']];
}
