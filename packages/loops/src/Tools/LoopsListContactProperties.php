<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * List Loops contact properties.
 *
 * Returns default and custom contact properties visible to the API key.
 */
class LoopsListContactProperties extends AbstractLoopsTool
{
    protected const NAME = 'loops_list_contact_properties';
    protected const DESCRIPTION = 'List Loops contact properties.';
    protected const METHOD = 'listContactProperties';
    protected const PARAMETERS = [];
}
