<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List certificate exposure zones used by a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCoverLetters.
 */
class AvalaraListCoverLetters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_cover_letters';
}