<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Search Open Library books and works.
 */
class OpenLibrarySearchBooks extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_search_books';
    protected const DESCRIPTION = 'Search Open Library books and works by query, title, author, subject, publisher, language preference, sorting, fields, and pagination.';
    protected const METHOD = 'searchBooks';
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => false, 'description' => 'General search query.'],
        'title' => ['type' => 'string', 'required' => false, 'description' => 'Title search.'],
        'author' => ['type' => 'string', 'required' => false, 'description' => 'Author search.'],
        'subject' => ['type' => 'string', 'required' => false, 'description' => 'Subject filter.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated result fields, or *,availability for availability data.'],
        'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort value such as new, old, random, or key.'],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter language preference.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number starting at 1.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
    ];
}
