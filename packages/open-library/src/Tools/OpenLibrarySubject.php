<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve works for a subject.
 */
class OpenLibrarySubject extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_subject';
    protected const DESCRIPTION = 'Retrieve works for an Open Library subject, optionally including subject details.';
    protected const METHOD = 'subject';
    protected const REQUIRED = ['subject'];
    protected const PARAMETERS = [
        'subject' => ['type' => 'string', 'required' => true, 'description' => 'Subject name, such as love or science fiction.'],
        'details' => ['type' => 'boolean', 'required' => false, 'description' => 'Include related subjects, publishers, authors, and publishing history when available.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum works.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Work offset.'],
    ];
}
