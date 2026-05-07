<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve one Open Library work.
 */
class OpenLibraryWork extends AbstractOpenLibraryTool
{
    protected const NAME = 'open_library_work';
    protected const DESCRIPTION = 'Retrieve one Open Library work by ID, such as OL45804W or /works/OL45804W.';
    protected const METHOD = 'work';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = ['id' => ['type' => 'string', 'required' => true, 'description' => 'Open Library work ID.']];
}
