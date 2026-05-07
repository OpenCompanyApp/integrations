<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * List Loops mailing lists.
 *
 * Returns mailing list IDs, names, descriptions, and visibility metadata.
 */
class LoopsListMailingLists extends AbstractLoopsTool
{
    protected const NAME = 'loops_list_mailing_lists';
    protected const DESCRIPTION = 'List Loops mailing lists with IDs, names, descriptions, and visibility.';
    protected const METHOD = 'listMailingLists';
    protected const PARAMETERS = [];

    /**
     * List mailing lists.
     *
     * @param  array<string, mixed>  $args  No arguments are required.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listMailingLists();
    }
}
