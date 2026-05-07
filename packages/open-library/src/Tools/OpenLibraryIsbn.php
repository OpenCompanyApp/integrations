<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve edition metadata by ISBN.
 */
class OpenLibraryIsbn extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_isbn';
    protected const DESCRIPTION = 'Retrieve Open Library edition metadata by ISBN 10 or 13.';
    protected const METHOD = 'isbn';
    protected const REQUIRED = ['isbn'];
    protected const PARAMETERS = ['isbn' => ['type' => 'string', 'required' => true, 'description' => 'ISBN 10 or 13.']];
}
