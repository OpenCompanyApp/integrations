<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Delete List tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingDeleteList extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_delete_list';
}