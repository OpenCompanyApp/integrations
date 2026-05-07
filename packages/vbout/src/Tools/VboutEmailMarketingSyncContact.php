<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Email Marketing Sync Contact tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutEmailMarketingSyncContact extends AbstractVboutOperationTool
{
    protected const OPERATION = 'email_marketing_sync_contact';
}