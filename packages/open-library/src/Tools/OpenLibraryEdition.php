<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve one Open Library edition.
 */
class OpenLibraryEdition extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_edition';
    protected const DESCRIPTION = 'Retrieve one Open Library edition by ID, such as OL7353617M or /books/OL7353617M.';
    protected const METHOD = 'edition';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = ['id' => ['type' => 'string', 'required' => true, 'description' => 'Open Library edition ID.']];
}
