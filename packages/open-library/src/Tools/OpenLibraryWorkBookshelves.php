<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve bookshelf counts for a work.
 */
class OpenLibraryWorkBookshelves extends OpenLibraryWork
{
    protected const NAME = 'open_library_work_bookshelves';
    protected const DESCRIPTION = 'Retrieve bookshelf counts for an Open Library work.';
    protected const METHOD = 'workBookshelves';
}
