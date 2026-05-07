<?php

namespace OpenCompany\Integrations\OpenLibrary\Tools;

/**
 * Retrieve ratings for a work.
 */
class OpenLibraryWorkRatings extends OpenLibraryWork
{
    protected const NAME = 'open_library_work_ratings';
    protected const DESCRIPTION = 'Retrieve rating summary for an Open Library work.';
    protected const METHOD = 'workRatings';
}
