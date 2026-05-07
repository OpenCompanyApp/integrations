<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * List editions for a work.
 */
class OpenLibraryWorkEditions extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_work_editions';
    protected const DESCRIPTION = 'List editions for an Open Library work.';
    protected const METHOD = 'workEditions';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Open Library work ID.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum editions.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Edition offset.'],
    ];
}
