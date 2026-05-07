<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Remove Tag tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingRemoveTag extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_remove_tag';
}